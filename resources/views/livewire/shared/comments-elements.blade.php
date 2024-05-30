<div class="mt-5">
    <!-- Display existing comments -->
    @foreach($chirp->comments as $comment)
    <div class="mb-3 comment-box p-3">

        {{-- <strong>{{ $comment->user->name }}</strong> <!-- Assuming a 'user' relationship --> --}}
        <div class="d-flex align-items-center">
            <img class="me-2" src="{{ $comment->user->getProfilePicURL() }}" style="object-fit: cover; width: 50px; height: 50px; border-radius:50%;" alt="User Avatar">
            <a class="clickable-user" href="{{ route('users.show', $comment->user->id) }}"><h6>{{ $comment->user->name }}</h6></a>
        </div>

        <div class="ms-5 mt-3">
            {{ $comment->content }}
        </div>
        <div class="text-end">
            <small>{{ $comment->created_at->diffForHumans() }}</small>
        </div>
    </div>
    @endforeach

    <!-- Comment form -->
    @auth
    <div>
        <form action="{{ route('chirps.comments.store', $chirp->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control fs-6" rows="3" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Meow back >:3</button>
        </form>
    </div>
    @else
    <p>You need to <a href="{{ route('login') }}">login</a> to post a comment.</p>
    @endauth
</div>
