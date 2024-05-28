<?php

namespace App\Livewire;

use Livewire\Volt\Component;
use App\Models\Chirp;
use Livewire\WithPagination;

class ChirpListComponent extends Component
{

    use WithPagination;
    public $chirps;
    public $editing;

    public function mount()
    {
        $this->getChirps();
    }

    public function getChirps()
    {
        $this->chirps = Chirp::with('user')->latest()->get();

        return view('livewire.chirp-list-component',[
            'chirps' => Chirp::paginate(2),
        ]);
    }

    public function editChirp(Chirp $chirp)
    {
        $this->editing = $chirp;
    }

    public function deleteChirp(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        $this->getChirps();
    }

    // public function render()
    // {
    //     return view('livewire.chirp-list-component',[
    //         'chirps' => Chirp::paginate(2),
    //     ]);
    // }
}
