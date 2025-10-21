<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\Section;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dashboard extends Component
{
    /**
     * Handles the admin dashboard with metrics, trends, and system controls.
     * Provides real-time booking analytics and maintenance mode management.
     */

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public array $days = [];
    public array $bookingCounts = [];
    public int $totalEarnings = 0;
    public int $totalBookings = 0;
    public int $availableSections = 0;
    public int $unpaidInvoices = 0;
    public bool $maintenanceMode = false;
    public string $dateRangeStart = '';
    public string $dateRangeEnd = '';
    public Carbon $currentViewDate;

    public function mount(): void
    {
        $this->initializeDateRange();
        $this->calculateMetrics();
        $this->loadMaintenanceStatus();
    }

    /**
     * Initialize the date range for the dashboard (last 2 months).
     */
    private function initializeDateRange(): void
    {
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subMonths(2);
        $this->currentViewDate = $endDate;

        $this->dateRangeStart = $startDate->toDateString();
        $this->dateRangeEnd = $endDate->toDateString();

        $this->generateDayArray($startDate, $endDate);
    }

    /**
     * Generate array of days within the date range.
     */
    private function generateDayArray(Carbon $startDate, Carbon $endDate): void
    {
        $this->days = CarbonPeriod::create($startDate, $endDate)->toArray();
        $this->loadChartData();
    }

    /**
     * Calculate all dashboard metrics using efficient Eloquent queries with caching.
     * Cache is valid for 1 hour to reduce database queries.
     */
    private function calculateMetrics(): void
    {
        // Cache key for dashboard metrics
        $cacheKey = 'dashboard_metrics_' . now()->format('Y-m-d-H');

        $metrics = Cache::remember($cacheKey, now()->addHours(1), function () {
            // Calculate total earnings from all bookings
            // Formula: (capacity_adults * price) + (capacity_children * price * 0.5)
            $totalEarnings = Booking::query()
                ->selectRaw('COALESCE(SUM((capacity_adults * price) + (capacity_children * price * 0.5)), 0) as total')
                ->value('total');

            // Count sections with active bookings (where booking is currently ongoing)
            $activeSectionCount = 0;
            $now = Carbon::now();

            foreach (Section::with('bookings')->get() as $section) {
                foreach ($section->bookings as $booking) {
                    if ($booking->start_time && $booking->end_time) {
                        if ($now->isBetween(
                            Carbon::parse($booking->start_time),
                            Carbon::parse($booking->end_time)
                        )) {
                            $activeSectionCount++;
                            break; // Only count once per section
                        }
                    }
                }
            }

            return [
                'totalEarnings' => (int) $totalEarnings,
                'totalBookings' => (int) Booking::count(),
                'totalSections' => (int) Section::count(),
                'activeSections' => $activeSectionCount,
                'unpaidInvoices' => (int) Booking::query()
                    ->whereDoesntHave('payments', function ($query) {
                        $query->where('status', 'completed');
                    })
                    ->count(),
            ];
        });

        $this->totalEarnings = $metrics['totalEarnings'];
        $this->totalBookings = $metrics['totalBookings'];
        $this->availableSections = $metrics['totalSections'] - $metrics['activeSections'];
        $this->unpaidInvoices = $metrics['unpaidInvoices'];
    }

    /**
     * Load booking data for the chart.
     */
    private function loadChartData(): void
    {
        $this->bookingCounts = [];

        foreach ($this->days as $day) {
            $dateString = $day->toDateString();
            $count = Section::query()
                ->whereHas('bookings', function ($query) use ($dateString) {
                    $query->whereDate('start_time', '<=', $dateString)
                        ->whereDate('end_time', '>=', $dateString);
                })
                ->count();

            $this->bookingCounts[$dateString] = $count;
        }
    }

    /**
     * Load current maintenance mode status.
     */
    private function loadMaintenanceStatus(): void
    {
        $this->maintenanceMode = (bool) cache('maintenance_mode', false);
    }

    /**
     * Navigate to previous month's data.
     */
    public function previousMonth(): void
    {
        $this->currentViewDate = $this->currentViewDate->copy()->subMonth();
        $startDate = $this->currentViewDate->copy()->subMonths(2);
        $endDate = $this->currentViewDate;

        $this->dateRangeStart = $startDate->toDateString();
        $this->dateRangeEnd = $endDate->toDateString();

        $this->generateDayArray($startDate, $endDate);
    }

    /**
     * Navigate to next month's data.
     */
    public function nextMonth(): void
    {
        $endDate = $this->currentViewDate->copy()->addMonth();
        // Prevent going beyond today
        if ($endDate > Carbon::now()) {
            $endDate = Carbon::now();
        }

        $this->currentViewDate = $endDate;
        $startDate = $endDate->copy()->subMonths(2);

        $this->dateRangeStart = $startDate->toDateString();
        $this->dateRangeEnd = $endDate->toDateString();

        $this->generateDayArray($startDate, $endDate);
    }

    /**
     * Toggle maintenance mode with cache update.
     */
    public function toggleMaintenanceMode(): void
    {
        $this->maintenanceMode = !$this->maintenanceMode;

        // Update cache
        cache(['maintenance_mode' => $this->maintenanceMode], now()->addDays(1));

        // Optionally update .env file (requires proper file handling)
        if ($this->maintenanceMode) {
            Artisan::call('down', ['--render' => 'errors::503']);
        } else {
            Artisan::call('up');
        }

        $this->dispatch('refresh', message: $this->maintenanceMode ? 'Maintenance mode enabled' : 'Maintenance mode disabled');
    }

    /**
     * Render the dashboard view with all metrics.
     */
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalEarnings' => $this->totalEarnings,
            'totalBookings' => $this->totalBookings,
            'availableSections' => $this->availableSections,
            'unpaidInvoices' => $this->unpaidInvoices,
            'maintenanceMode' => $this->maintenanceMode,
            'dateRangeStart' => $this->dateRangeStart,
            'dateRangeEnd' => $this->dateRangeEnd,
            'days' => $this->days,
            'bookingCounts' => $this->bookingCounts,
        ]);
    }
}
