<?php
 
use App\Models\Chirp; 
use function Livewire\Volt\{on, state}; 
 
$getChirps = fn () => $this->chirps = Chirp::with('user')->latest()->get();

$disableEditing = function () { 
    $this->editing = null;
 
    return $this->getChirps();
}; 
 
state(['chirps' => $getChirps, 'editing' => null]); 
 
on([ 
    'chirp-created' => $getChirps,
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
</div>