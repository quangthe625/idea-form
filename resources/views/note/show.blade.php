
<x-app-layout>
    <div class="container my-5 ">
        <a href="{{ route('dashboard') }}" class="mb-4 btn btn-outline-secondary btn-outline-danger">
            &larr; Back to Notes
        </a>



        <div class="mb-4 border rounded shadow-sm d-flex" style="background-color: #fff;">
            <!-- Left Sidebar -->
            <div class="p-3 text-center border-end" style="width: 180px; background-color: #f8f9fa;">
                <img src="{{ $note->user->avatar ? asset('storage/' . $note->user->avatar) : asset('/images/user_avatar.png') }}"
                     class="mb-2 rounded img-fluid" width="100" height="100" alt="Avatar">

                <div><strong>{{ $note->user->name }}</strong></div>
                <div class="text-muted small">Join Date: {{ $note->user->created_at->format('M Y') }}</div>

            </div>

            <!-- Main Post Content -->
            <div class="p-3 flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-primary fs-5">Re: {{ $note->title }}</h5>
                    <span class="text-muted small">{{ $note->created_at->format('Y-m-d, h:i A') }}</span>
                </div>

                <p class="text-muted">Posted by: {{ $note->user->name }}</p>
                <hr class="my-2">

                <div class="mb-3" style="white-space: pre-line;">
                    {{ $note->text }}
                </div>

                <form action="{{ route('notes.like', $note->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button class="btn btn-sm {{ $note->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                        ❤️ {{ $note->likes->count() }}
                    </button>
                </form>
            </div>
        </div>



        <hr>
        <h4 Class="mb-1 fw-bold fs-3">Comments</h4>

        @foreach ($note->comments as $comment)
    <div class="mb-2 border rounded shadow-sm d-flex" style="background-color: #fff;">
        <!-- Left Sidebar -->
        <div class="p-2 d-flex flex-column justify-content-center align-items-center border-end"
            style="width: 180px; background-color: #f8f9fa;">
            <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('/images/user_avatar.png') }}"
                class="mb-2 rounded img-fluid" width="70" height="70" alt="Avatar">

            <div><strong>{{ $comment->user->name }}</strong></div>
        </div>


        <!-- Comment Body -->
        <div class="p-3 flex-grow-1">
            <div class="mb-1 d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    @if ($comment->user->is_author) {{-- Replace with your logic --}}
                        <span class="text-white badge bg-primary ms-1">autor</span>
                    @endif
                    <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="text-muted">
                    <i class="bi bi-reply me-2" title="Reply"></i>
                    <i class="bi bi-heart" title="Like"></i>
                </div>
            </div>

            <p class="mb-0" style="white-space: pre-line;">{{ $comment->body }}</p>
        </div>
    </div>
@endforeach



        @auth
            <form method="POST" action="{{ route('comments.store', $note->id) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="3" placeholder="Add a comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        @endauth

    </div>
</x-app-layout>
