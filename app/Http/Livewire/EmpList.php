<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmpList extends Component
{
    public $users;
    public $firstname;
    public $lastname;
    public $email;
    public $department;
    public $password;
    public $password_confirmation;
    public $usertype;
    public $status;
    
    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'department' => 'required',
        'password' =>'required|min:6',
        'password_confirmation' => 'required|confirm',
        'usertype' => 'required',
        'status' => 'required',
    ];
    public function openModal($modalId)
    {
        $this->emit('showModal', $modalId);
    }
    public function createEmployee()
    {
        $this->reset(['firstname', 'lastname', 'email', 'department', 'password', 'password_confirmation', 'usertype', 'status']);
        $this->emit('hideModal', 'createEmployeeModal');
    }
    public function render()
    {
        return view('livewire.emp-list')->with('users',$this->users);
    }
}
