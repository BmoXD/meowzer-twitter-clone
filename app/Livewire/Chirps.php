<?php

// namespace App\Http\Livewire;

// use Livewire\Component;
// use App\Models\Chirp;

// class Chirps extends Component
// {
//     public $chirps;
//     public $editing;

//     public function mount()
//     {
//         $this->getChirps();
//     }

//     public function getChirps()
//     {
//         $this->chirps = Chirp::with('user')->latest()->get();
//     }

//     public function editChirp(Chirp $chirp)
//     {
//         $this->editing = $chirp;
//     }

//     public function deleteChirp(Chirp $chirp)
//     {
//         $this->authorize('delete', $chirp);

//         $chirp->delete();

//         $this->getChirps();
//     }

//     public function render()
//     {
//         return view('livewire.chirp-list');
//     }
// }