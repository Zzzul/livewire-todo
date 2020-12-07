<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class Register extends Component
{
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $name = '';


    public function register()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:5',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->flash('success', 'Account created successfully!', [
            'position'          =>  'top',
            'timer'             =>  1500,
            'toast'             =>  true,
        ]);

        redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
