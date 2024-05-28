<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($chirps as $chirp)
        @include('livewire.shared.chirp-box')
    @endforeach
</div>

{{ $chirps->links() }}