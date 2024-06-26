<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8  dark:bg-gray-800 shadow sm:rounded-lg">
                <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id)}}">
                    @csrf
                    @method('put')
                    <div class="">
                        <div class="d-flex align-items-center">
                            <img style="width:150px; height:150px; object-fit:cover; border-radius: 50%" src="{{ $user->getProfilePicURL() }}" class="me-2" alt="User Avatar">
                            <div>
                                @if ($isEditing ?? false)
                                    <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="text-danger fs-6"> {{ $message }} </span>
                                    @enderror
                                @else
                                    <h3 class="card-title mb-0"><a href="{{ route('users.show', $user->id) }}"> {{ $user->name }}
                                    </a></h3>
                                    <span class="fs-6 dark:text-white">{{ $user->email }}</span>
                                @endif
                            </div>
                            <div class="ms-auto p-2">
                                @if (Auth::id() === $user->id)
                                    @if ($isEditing ?? false)
                                        <a href="{{ route('users.show',$user->id) }}">View</a>
                                    @else
                                        <a href="{{ route('users.edit',$user->id) }}">Edit</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="mx-3 mt-4">
                            @if ($isEditing ?? false)
                                <div class="my-2">
                                    <label for="" class="dark:text-white">Upload Profile Picture:</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            @endif
                            <h5 class="fs-5 dark:text-white"> Bio : </h5>
                            @if ($isEditing ?? false)
                                <div>
                                    <textarea name="bio" class="form-control" id="bio" cols="30" rows="3">{{ $user->bio }}</textarea>
                                </div>
                                <button class="btn btn-primary btn-sm my-3"> Save </button>
                                @error('name')
                                        <span class="text-danger fs-6"> {{ $message }} </span>
                                @enderror
                            @else
                                <p class="fs-6 dark:text-white dark">
                                    {{ $user->bio }}
                                </p>
                            @endif
                            <div class="d-flex justify-content-start dark:text-white">
                                <a href="{{ route('users.followers',$user->id) }}" class="fw-light nav-link fs-6 me-3"> <span class="bi bi-person-fill me-1">
                                    </span> {{ $user->followers()->count()}} </a>
                                <a href="{{ route('users.followings',$user->id) }}" class="fw-light nav-link fs-6 me-3"> <span class="bi bi-person-plus-fill me-1">
                                    </span> {{ $user->followings()->count()}} </a>
                                <a href="#meows" class="fw-light nav-link fs-6 me-3"> <span class="bi bi-sticky-fill me-1">
                                    </span> {{ $user->chirps()->count() }} </a>
                                <label class="fw-light nav-link fs-6"> <span class="bi bi-chat-fill me-1">
                                    </span> {{ $user->comments()->count() }} </label>
                            </div>
                            
                        </div>
                    </div>
                </form>
                @if (Auth::id() !== $user->id)
                    <div class="mt-3">
                        @if (Auth::user()->isFollowing($user))
                            <form method="POST" action=" {{ route('users.unfollow', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"> Unfollow </button>
                            </form>
                        @else
                            <form method="POST" action=" {{ route('users.follow', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mx-20 d-flex justify-content-center dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl mt-3" id="meows">
                    <h2 class="text-center dark:text-white">{{ $user->name }}'s Meows</h2>
                    <hr>
                    @if ($user->chirps())
                        <livewire:chirps.list :user="$user" />
                    @else
                        <h5 class="text-center dark:text-white">User has no posts ;3;</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>