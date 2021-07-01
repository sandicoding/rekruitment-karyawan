<?php

namespace App\Http\Livewire\Admin;

use App\Models\User as ModelsUserController;
use Livewire\Component;

class UserController extends Component
{
    public $users_id;
    public $name;
    public $email;
    public $no_telpon;
    public $alamat;
    public $roles;
    public $created_at;
    public $updated_at;


    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    public function render()
    {
        return view('livewire.admin.users', [
            'items' => ModelsUserController::all()
        ]);
    }

    public function store()
    {
        $this->_validate();
        ModelsUserController::create([
            'name'  => $this->name,
            'email'  => $this->email,
            'no_telpon'  => $this->no_telpon,
            'alamat' => $this->alamat,
            'email'  => $this->email,
            'roles'  => $this->roles,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();
        ModelsUserController::find($this->users_id)->update([
            'name'  => $this->name,
            'email'  => $this->email,
            'no_telpon'  => $this->no_telpon,
            'alamat' => $this->alamat,
            'roles'  => $this->roles,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ModelsUserController::find($this->users_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'name'  => 'required',
            'email'  => 'required',
            'roles'  => 'required',
            'created_at'  => 'required',
            'updated_at'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataById($users_id)
    {
        $users = ModelsUserController::find($users_id);
        $this->users_id = $users->id;
        $this->name = $users->name;
        $this->email = $users->email;
        $this->no_telpon = $users->no_telpon;
        $this->alamat = $users->alamat;
        $this->roles = $users->roles;
        $this->created_at = $users->created_at;
        $this->updated_at = $users->updated_at;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getId($users_id)
    {
        $users = ModelsUserController::find($users_id);
        $this->users_id = $users->id;
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
        $this->users_id = null;
        $this->name = null;
        $this->email = null;
        $this->no_telpon = null;
        $this->alamat = null;
        $this->roles = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
