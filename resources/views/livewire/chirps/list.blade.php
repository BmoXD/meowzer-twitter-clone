<?php
 
use App\Models\Chirp; 
use function Livewire\Volt\{on, state, with, usesPagination}; 
use Livewire\WithPagination;

usesPagination();

// with(fn () => ['chirps' => Chirp::with('user')->latest()->paginate(5)]);

state(['editing' => null, 'user' => null]);

with(function ()
{
    //dd($this->user);
    $query = Chirp::with('user')->latest();
    if ($this->user) {
        $query->where('user_id', $this->user->id);
    }
    return ['chirps' => $query->paginate(5)];
});

$disableEditing = function () { 
    $this->editing = null;
    //$this->getChirps();
}; 


on([ 
    'chirp-created' => '$refresh',
    'chirp-updated' => $disableEditing,
    'chirp-edit-canceled' => $disableEditing,
]); 

$edit = function (Chirp $chirp){
    $this->editing = $chirp;
    //$this->getChirps();
};

$delete = function (Chirp $chirp) {
    $this->authorize('delete', $chirp);
    $chirp->delete();
    //$this->getChirps();
};


 
?>

<div class="mt-6 shadow-sm rounded-lg divide-y"> 
    @foreach ($chirps as $chirp)
        @include('livewire.shared.chirp-box')
    @endforeach 

    <div>
        {{ $chirps->links() }}
    </div>
</div>
