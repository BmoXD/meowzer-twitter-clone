<div>
    @auth()
    @if (Auth::user()->likesChirp($chirp))
    
    <form action="{{ route('chirps.unlike', $chirp->id) }}" method="POST">
        @csrf
        <button type="submit" href="#" class="fw-light nav-link fs-6">
            <span class="bi bi-heart-fill me-1"></span>
            {{ $chirp->likes()->count() }}
        </button>
    </form>
    @else
    <form action="{{ route('chirps.like', $chirp->id) }}" method="POST">
        @csrf
        <button type="submit" href="#" class="fw-light nav-link fs-6">
            <span class="bi bi-heart me-1"></span>
            {{ $chirp->likes()->count() }}
        </button>
    </form>
    @endif
    @endauth
    @guest
    <a href="{{route('login')}}" class="fw-light nav-link fs-6">
        <span class="bi bi-heart me-1"></span>
        {{ $chirp->likes()->count() }}
    </a>
    @endguest
</div>