<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Material;

class UserMaterials extends Component
{
    public $materials;
    public $materialSearch = '';

    public function mount()
    {
        $this->materials = Material::where('title', 'LIKE', '%' . $this->materialSearch . '%')->get();
    }

    public function render()
    {
        $this->materials = Material::where('title', 'LIKE', '%' . $this->materialSearch . '%')->get();
        return view('livewire.user-materials', [
            'materials' => $this->materials
        ]);
    }
}