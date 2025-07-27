<div>
    <x-slot:header>
        FAQS
    </x-slot>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex flex-row">
                <h5>List of FAQS</h5>
                <div class="ml-auto"><a href="{{ route('admin.cms.faq.create') }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i></a></div>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td scope="row">{{ $question->id }}</td>
                                <td scope="row">{{ $question->question }}</td>
                                <td scope="row">{{ $question->answer }}</td>
                                <td class="d-flex flex-row justify-content-center">
                                    <div class="flex-col mx-1"><a href="{{ route('admin.cms.faq.edit', $question->id) }}" class="btn btn-secondary"><i
                                                class="fas fa-edit"></i></a></div>
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
