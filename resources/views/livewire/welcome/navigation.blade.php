{{-- <nav class="-mx-3 flex flex-1 justify-end">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Register
            </a>
        @endif
    @endauth
</nav> --}}
<div>
    @auth
    <a href="{{ url('/chirps') }}" class="btn btn-primary active" role="button" aria-pressed="true">Open Pandora's Box</a>
    
    @else
    <a href="{{ route('login') }}" class="btn btn-primary active" role="button" aria-pressed="true">Login</a>
    
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-secondary active" role="button" aria-pressed="true">Register</a>
    @endif
    @endauth
</div>