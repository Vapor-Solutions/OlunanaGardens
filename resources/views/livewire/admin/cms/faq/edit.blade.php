<div>
    <x-slot name="header">
        FAQS
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Edit this Frequently Answered Question</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <input type="text" wire:model='faq.question' class="form-control" name="question" id="question" aria-describedby="question"
                        placeholder="Enter the Question that is Commonly Asked" />
                    @error('faq.question')
                        <small id="question" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Answer</label>
                    <textarea class="form-control" name="answer" id="answer" rows="3" wire:model='faq.answer' placeholder="Enter the answer for the question above"></textarea>
                    @error('faq.answer')
                        <small id="question" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary" wire:click='save'>Submit</button>


            </div>
        </div>
    </div>
</div>
