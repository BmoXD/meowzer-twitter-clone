<div class="chirp-box p-3 my-4 w-50 mx-auto">
    <a class="clickable-user" href="{{ route('users.show', $following->id) }}">
        <div class="d-flex align-items-center">
            <img class="me-2" src="{{ $following->getProfilePicURL() }}" style="object-fit: cover; width: 50px; height: 50px; border-radius:50%;" alt="User Avatar">
            <h2 class="">{{ $following->name }}</h2>
        </div>
    </a>
    <div class="user-card-paw"></div>
</div>