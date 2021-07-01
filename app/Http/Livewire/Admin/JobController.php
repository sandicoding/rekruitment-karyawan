<?php

namespace App\Http\Livewire\Admin;

use App\Models\Job as ModelsJobController;
use Livewire\Component;

class JobController extends Component
{
    public $jobs_id;
    public $name;
    public $description;
    public $type;
    public $pengalaman;
    public $created_at;
    public $updated_at;


    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    public function render()
    {
        return view('livewire.admin.jobs', [
            'items' => ModelsJobController::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        ModelsJobController::create([
            'name'  => $this->name,
            'description'  => $this->description,
            'type'  => $this->type,
            'pengalaman'  => $this->pengalaman,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();
        ModelsJobController::find($this->jobs_id)->update([
            'name'  => $this->name,
            'description'  => $this->description,
            'type'  => $this->type,
            'pengalaman'  => $this->pengalaman,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsJobController::find($this->jobs_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'name'  => 'required',
            'description'  => 'required',
            'type'  => 'required',
            'pengalaman'  => 'required',
            'created_at'  => 'required',
            'updated_at'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($jobs_id)
    {
        $jobs = ModelsJobController::find($jobs_id);
        $this->jobs_id = $jobs->id;
        $this->name = $jobs->name;
        $this->description = $jobs->description;
        $this->type = $jobs->type;
        $this->pengalaman = $jobs->pengalaman;
        $this->created_at = $jobs->created_at;
        $this->updated_at = $jobs->updated_at;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($jobs_id)
    {
        $jobs = ModelsJobController::find($jobs_id);
        $this->jobs_id = $jobs->id;
    }

    public function toggleForm($form)
    {
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->jobs_id = null;
        $this->name = null;
        $this->description = null;
        $this->type = null;
        $this->pengalaman = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
