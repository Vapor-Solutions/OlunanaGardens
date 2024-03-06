<div>
    <x-slot name="header">
        FAQS
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>List of FAQS</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td scope="row">{{ $question->id }}</td>
                                <td scope="row">{{ $question->question }}</td>
                                <td scope="row">{{ $question->answer }}</td>
                                <td class="d-flex flex-row">
                                    <div class="flex-col mx-1"><button
                                            wire:click='delete({{ $question->id }})'class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
