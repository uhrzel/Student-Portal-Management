<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use DB;

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

        $user_assigned_role = DB::table('roles as r')
                                ->join('model_has_roles as mr', 'mr.role_id','r.id')
                                ->select('r.id','r.name')
                                ->where('mr.model_id',$this->user_id)
                                ->first();

        

        \Log::info('user role: '.$user_assigned_role->name);

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;

            //check if user has assigned roles
            if(!empty($user_assigned_role)){
                $this->selectedRoles = $user_assigned_role->id;
            }
            
        }
    }

    public function updateUser()
    {

        $user = User::findOrFail($this->user_id);

        

        $required_fields = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'file' => 'required|file|mimes:jpeg,jpg,png|max:1024', // Ensure the file is an image
            'file1' => 'required|file|mimes:jpeg,jpg,png|max:1024', // Ensure the file is an image
        ];

        //check if the role is teacher then remove image upload field
        if($this->selectedRoles === 2){
            $required_fields = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            ];
        }
        $validated = $this->validate($required_fields);
        
       
        
        if ($user) {
            // Store files temporarily to read their content

            $frontBase64 = null;
            $backBase64 = null;

            if($this->selectedRoles !== 2){
                $frontPath = $this->file->store('temp', 'public');
                $backPath = $this->file1->store('temp', 'public');
            
                // Convert to Base64
                $frontFullPath = storage_path('app/public/' . $frontPath);
                $backFullPath = storage_path('app/public/' . $backPath);
            
                $frontBase64 = base64_encode(file_get_contents($frontFullPath));
                $backBase64 = base64_encode(file_get_contents($backFullPath));
            }
           
        
            // Update the user with Base64 data

            if($this->email != $user->email){
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'id_picture_path_front' => $frontBase64,
                    'id_picture_path_back' => $backBase64,
                ]);
            }else{

                //ignore email if not changed
                $user->update([
                    'name' => $this->name,
                    'id_picture_path_front' => $frontBase64,
                    'id_picture_path_back' => $backBase64,
                ]);
            }
           

            if($this->selectedRoles !== 2){
        
            // Remove temporary files
            unlink($frontFullPath);
            unlink($backFullPath);

            }
        
            if ($this->selectedRoles) {
                $user->roles()->sync($this->selectedRoles);
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
