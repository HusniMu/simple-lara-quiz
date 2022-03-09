<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Material;

class Materials extends Component
{
    public $materials;
    public $materialSearch = '';

    public $listeners = ['removeMaterial'];

    public function mount()
    {
        $this->materials = Material::where('title', 'LIKE', '%' . $this->materialSearch . '%')->get();
    }

    public function removeMaterial(Material $material)
    {
        $material->delete();
    }

    public function render()
    {
        $this->materials = Material::where('title', 'LIKE', '%' . $this->materialSearch . '%')->get();
        return view('livewire.materials', [
            'materials' => $this->materials
        ]);
    }
}