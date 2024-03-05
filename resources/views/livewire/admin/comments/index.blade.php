<div>
    <x-slot name="header">
        Comments
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of Comments</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Client Name</th>
                            <th>Post Details</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Approve/Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td scope="row">{{ $comment->id }}</td>
                                <td scope="row">{{ $comment->client->name }}</td>
                                <td scope="row">{{ $comment->post->title }}</td>
                                <td scope="row">{{ $comment->content }}</td>
                                {{-- <td scope="row">{{ $comment->is_approved }}</td> --}}
                                @if ($comment->is_approved == 1)
                                <td scope="row" class="text-success">Approved</td>
                                @else
                                <td scope="row" class="text-danger">Pending</td>
                                @endif
                        </>

                        <td class="d-flex flex-row">
                            <div class="flex-col mx-1">
                                <a href="" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="flex-col mx-1"><button
                                    wire:click='delete({{ $comment->id }})'class="btn btn-danger"><i
                                        class="fas fa-trash"></i></button></div>
                        </td>
                        <td>
                            <a href="" class="btn btn-success"
                                wire:click.prevent="approveComment({{ $comment->id }})">Approve</a>
                            <a href="" class="btn btn-danger"
                                wire:click.prevent="rejectComment({{ $comment->id }})">Reject</a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>
