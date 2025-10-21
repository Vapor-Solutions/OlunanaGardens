{{-- Payment Status Component --}}
@props([
    'booking',
    'compact' => false,
])

@php
    $totalCost = $booking->total_cost;
    $totalPaid = $booking->total_paid;
    $remaining = $booking->remaining_balance;
    $isPaid = $booking->isFullyPaid();

    // Calculate percentage
    $percentage = $totalCost > 0 ? ($totalPaid / $totalCost) * 100 : 0;
@endphp

<div {{ $attributes->merge(['class' => 'payment-status']) }}>
    @if($compact)
        {{-- Compact display --}}
        <div class="flex items-center justify-between gap-2">
            <small class="text-muted">
                KES {{ number_format($totalPaid) }} / {{ number_format($totalCost) }}
            </small>
            <div class="progress" style="width: 60px; height: 6px;">
                <div
                    class="progress-bar bg-{{ $isPaid ? 'success' : 'warning' }}"
                    style="width: {{ $percentage }}%"
                ></div>
            </div>
        </div>
    @else
        {{-- Full display --}}
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3">Payment Status</h6>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Cost:</span>
                        <strong>KES {{ number_format($totalCost) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Paid:</span>
                        <span class="text-success">KES {{ number_format($totalPaid) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Outstanding:</span>
                        <span class="text-{{ $remaining > 0 ? 'danger' : 'success' }}">
                            KES {{ number_format($remaining) }}
                        </span>
                    </div>
                </div>

                <div class="progress" style="height: 24px;">
                    <div
                        class="progress-bar bg-{{ $isPaid ? 'success' : 'warning' }}"
                        style="width: {{ $percentage }}%"
                        role="progressbar"
                        aria-valuenow="{{ $percentage }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        {{ round($percentage) }}%
                    </div>
                </div>

                @if($isPaid)
                    <div class="alert alert-success mt-3 mb-0">
                        <i data-feather="check-circle" style="width: 16px; height: 16px; display: inline;"></i>
                        <small class="ms-2">Fully paid</small>
                    </div>
                @else
                    <div class="alert alert-warning mt-3 mb-0">
                        <i data-feather="alert-circle" style="width: 16px; height: 16px; display: inline;"></i>
                        <small class="ms-2">{{ number_format($remaining) }} KES outstanding</small>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
