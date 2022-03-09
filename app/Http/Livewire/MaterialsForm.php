<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Material;

class MaterialsForm extends Component
{
    public $material;
    public $materialId,
        $materialTitle,
        $materialBody;

    public function mount()
    {
        $material = Material::find(request('material'));
        $this->material = $material;
        $this->materialId = $material === null ? $material : $material->id;
        $this->materialTitle = $material === null ? $material : $material->title;
        $this->materialBody = $material === null ? $material : $material->body;
    }

    public function createMoreMaterial()
    {
        Material::create([
            'title' => $this->materialTitle,
            'body' => $this->materialBody,
        ]);
        return redirect(route('materials-form', ['material' => 0]));
    }
    public function createMaterial()
    {
        Material::create([
            'title' => $this->materialTitle,
            'body' => $this->materialBody,
        ]);
        return redirect(route('materials'));
    }
    public function updateMaterial(Material $material)
    {
        $material->update([
            'title' => $this->materialTitle,
            'body' => $this->materialBody,
        ]);
        return redirect(route('materials'));
    }


    public function render()
    {
        return view('livewire.materials-form', [
            'material' => $this->material
        ]);
    }
}