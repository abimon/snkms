<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersManagement extends Component
{
    public $users=[];
    public $user;
    public $id;
    public $role;
    public $roles =[
        'Customer',
        'Admin',
        'Employee'
    ];
    public function onChangeRole($id){
        $user=User::findOrFail($id);
        $user->role=$this->role;
        $user->update();
    }
    public function delete($id){
        User::destroy($id);
    }
    
    public function render()
    {
        $this->users=User::all();
        return view('livewire.users-management');
    }
}
