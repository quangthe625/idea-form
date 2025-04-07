<dialog @if($show) open @endif class="top-0 bg-opacity-50 border border-0 bg-dark w-100 h-100 position-fixed start-0">
    <div class="row d-flex align-items-center h-100">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <form class="p-5 mb-5 border bg-light border-1" wire:submit="save">
                <div class="mb-3 form-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" wire:model="title">
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label">Text</label>
                    <textarea class="form-control" rows="5" wire:model="text"></textarea>
                </div>

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="button" class="btn btn-secondary" wire:click="close">Cancel</button>
            </form>
        </div>
    </div>
</dialog>

