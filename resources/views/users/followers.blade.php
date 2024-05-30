<x-app-layout>
    <div class="container mx-20 dark:bg-gray-800 shadow sm:rounded-lg mt-5 pt-4">
        <h1 class="text-center dark:text-white"><span class="bi bi-person-fill"></span> ({{$followers->count()}}) {{ $user->name }}'s followers</h1>
        <hr>
        <div class="pb-4">
            @if($followers->isEmpty())
                <h5 class="text-center dark:text-white">User has no followers ;3;</h5>
            @else
                @foreach($followers as $following)
                    @include('shared.user-card')
                @endforeach
            @endif
        </div>
        {{ $followers->links() }} <!-- Pagination links -->
    </div>
</x-app-layout>