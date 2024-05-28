<?php
 
use App\Models\Chirp; 
use function Livewire\Volt\{on, state, with, usesPagination}; 
use Livewire\WithPagination;

usesPagination();

with(fn () => ['chirps' => Chirp::with('user')->latest()->paginate(5)]);

$disableEditing = function () { 
    $this->editing = null;
    $this->getChirps();
}; 

state(['editing' => null]); 

on([ 
    'chirp-created' => '$refresh',
    'chirp-updated' => $disableEditing,
    'chirp-edit-canceled' => $disableEditing,
]); 

$edit = function (Chirp $chirp){
    $this->editing = $chirp;
    $this->getChirps();
};

$delete = function (Chirp $chirp) {
    $this->authorize('delete', $chirp);
    $chirp->delete();
    $this->getChirps();
};


 
?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y"> 
    @foreach ($chirps as $chirp)
        @include('livewire.shared.chirp-box')
    @endforeach 

    <div>
        {{ $chirps->links() }}
    </div>
</div>
