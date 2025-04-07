<div>
    <div class="p-4 col-md-9 col-lg-10">
        <header class="mb-4 d-flex justify-content-between align-items-center">
            <h1 class="fw-bold">🛠️ Manage My Ideas</h1>
            <button class="btn btn-outline-secondary" wire:click="open">+ New Note</button>
        </header>

        {{-- Search and Sort --}}
        <div class="flex-wrap gap-2 mb-4 d-flex justify-content-between align-items-center">
            <form wire:submit.prevent="searchNotes" class="flex-grow-1 me-3">
                <input
                    type="text"
                    wire:model="search"
                    placeholder="🔍 Search your notes..."
                    class="form-control"
                >
            </form>

            <div class="btn-group" role="group">
                <button type="button" wire:click="$set('sortByLikes', 'desc')" class="btn btn-sm {{ $sortByLikes === 'desc' ? 'btn-primary' : 'btn-outline-primary' }}">🔥 Most Liked</button>
                <button type="button" wire:click="$set('sortByLikes', 'asc')" class="btn btn-sm {{ $sortByLikes === 'asc' ? 'btn-primary' : 'btn-outline-primary' }}">❄️ Least Liked</button>
                <button type="button" wire:click="$set('sortByLikes', null)" class="btn btn-sm {{ is_null($sortByLikes) ? 'btn-secondary' : 'btn-outline-secondary' }}">🧹 Clear Sort</button>
            </div>
        </div>

        {{-- Notes List --}}
        <div class="row gy-4">
            @foreach($notes as $note)
                <div class="">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1 fw-bold">
                                        <h5 class="mb-1 fw-bold fs-4">{{ \Illuminate\Support\Str::limit($note->title, 60, '...') }}</h5>
                                    </h5>
                                    <div>
                                        <small class="text-muted">❤️ {{ $note->likes->count() }} | Posted by: {{ $note->user->name }}</small>
                                        🕒 {{ $note->created_at->diffForHumans() }}
                                        💬 {{ $note->comments->count() }} Comments
                                    </div>
                                </div>

                                {{-- Edit/Delete buttons only for current user --}}
                                @auth
                                    @if ($note->user_id === auth()->id())
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-secondary" wire:click="edit({{ $note->id }})">✏️ Edit</button>
                                            <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $note->id }})" onclick="event.stopPropagation(); return confirm('Are you sure to delete this idea?')">🗑️ Delete</button>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <p class="mt-3 text-muted">{{ \Illuminate\Support\Str::limit($note->text, 60, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($notes->isEmpty())
                <div class="col-12">
                    <div class="text-center alert alert-warning">
                        No notes found matching "<strong>{{ $search }}</strong>"
                    </div>
                </div>
            @endif
        </div>
    </div>


</div>
