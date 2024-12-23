<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $email, $name, $user_id, $roles, $selectedRoles, $file, $file1;


    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->loadUserData();
        $this->loadRolesData();
    }

    public function loadRolesData()
    {
        $this->roles = Role::all();
    }

    public function loadUserData()
    {
        $user = User::findOrFail($this->user_id);

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function updateUser()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'file' => 'required|file|max:1024', // Max size: 1MB
            'file1' => 'required|file|max:1024', // Max size: 1MB
        ]);
        

        $validated = User::findOrFail($this->user_id);

        if ($validated) {
            $front = $this->file->store('id-picture', 'public');
            $back = $this->file1->store('id-picture', 'public');

            $validated->update([
                'name' => $this->name,
                'email' => $this->email,
                'id_picture_path_front' => $front,
                'id_picture_path_back' => $back,
            ]);

           

            if ($this->selectedRoles) {
                $validated->roles()->sync($this->selectedRoles);
            }


            toastr()->success('User updated successfully!');
            return redirect()->route('admin.users');
        }
    }

    public function render()
    {
        return view('livewire.admin.users.edit',);
    }
}
