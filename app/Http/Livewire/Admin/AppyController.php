<?php

namespace App\Http\Livewire\Admin;

use App\Models\Apply as ModelsAppyController;
use Livewire\Component;

class AppyController extends Component
{
    public $applies_id;
    public $id_user;
    public $id_job;
    public $status;
    public $description;
    public $file;
    public $created_at;
    public $updated_at;


    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    public function render()
    {
        return view('livewire.admin.applies', [
            'items' => ModelsAppyController::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        ModelsAppyController::create([
            'id_user'  => $this->id_user,
            'id_job'  => $this->id_job,
            'status'  => $this->status,
            'description'  => $this->description,
            'file'  => $this->file,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();
        ModelsAppyController::find($this->applies_id)->update([
            'id_user'  => $this->id_user,
            'id_job'  => $this->id_job,
            'status'  => $this->status,
            'description'  => $this->description,
            'file'  => $this->file,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsAppyController::find($this->applies_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'id_user'  => 'required',
            'id_job'  => 'required',
            'status'  => 'required',
            'description'  => 'required',
            'file'  => 'required',
            'created_at'  => 'required',
            'updated_at'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($applies_id)
    {
        $applies = ModelsAppyController::find($applies_id);
        $this->applies_id = $applies->id;
        $this->id_user = $applies->id_user;
        $this->id_job = $applies->id_job;
        $this->status = $applies->status;
        $this->description = $applies->description;
        $this->file = $applies->file;
        $this->created_at = $applies->created_at;
        $this->updated_at = $applies->updated_at;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($applies_id)
    {
        $applies = ModelsAppyController::find($applies_id);
        $this->applies_id = $applies->id;
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
        $this->applies_id = null;
        $this->id_user = null;
        $this->id_job = null;
        $this->status = null;
        $this->description = null;
        $this->file = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
