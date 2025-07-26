<div>
    <x-slot:header>Booking Requests</x-slot:header>

    <div class="card">
        <div class="card-header">
            <h5>List of Booking Requests</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-borderless">
                <thead class="">

                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Alias</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Type of Event</th>
                        <th>No. of adults</th>
                        <th>No. of children</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($bookingRequests as $request)
                        <tr>
                            <td scope="row">{{ $request->id }}</td>
                            <td>{{ Carbon\Carbon::parse($request->start_time)->format('jS F, Y h:i:sA') }}</td>
                            <td>{{ $request->client->name }}</td>
                            <td>{{ $request->client->email }}</td>
                            <td>{{ $request->client->phone_number }}</td>
                            <td>{{ $request->eventType->title }}</td>
                            <td>{{ $request->capacity_adults }}</td>
                            <td>{{ $request->capacity_children }}</td>
                            <td class="d-flex flex-row justify-content-center">
                                <div class="flex-col m-1">
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-primary btn" data-toggle="modal"
                                        data-target="#modalId{{ $request->id }}">
                                        <i class="fas fa-check"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-backdrop and data-keyboard -->
                                    <div class="modal fade" wire:ignore id="modalId{{ $request->id }}" tabindex="-1"
                                        data-backdrop="static" data-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Make Booking for Request No. #{{ $request->id }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="sections" class="form-label">Section(S)</label>
                                                        <select wire:model.live='selectedSections' multiple
                                                            class="form-control" name="sections" id="sections">
                                                            <option selected>Select one</option>
                                                            @foreach ($sections as $section)
                                                                @if (!$section->IsBooked($request->start_time))
                                                                    <option value="{{ $section->id }}">
                                                                        {{ $section->name }} -
                                                                        {{ $section->location ?? '' }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click='makeBooking({{ $request }})'>Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{ $bookingRequests->links() }}
</div>
