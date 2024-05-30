<x-app-layout>
    <div class="container mx-20 dark:bg-gray-800 shadow sm:rounded-lg mt-5 pt-4">
        <h1 class="text-center dark:text-white"><span class="bi bi-person-plus-fill"></span> ({{$followings->count()}}) {{ $user->name }}'s Followings</h1>
        <hr>
        <div class="pb-4">
            @if($followings->isEmpty())
                <h5 class="text-center dark:text-white">User is not following anyone ;3;</h5>
            @else
                @foreach($followings as $following)
                    @include('shared.user-card')
                @endforeach
            @endif
        </div>
        {{ $followings->links() }} <!-- Pagination links -->
    </div>
</x-app-layout>