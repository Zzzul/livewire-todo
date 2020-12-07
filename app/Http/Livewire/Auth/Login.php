<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email = '';
    public $password = '';

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where(['email' => $this->email])->get();

        if (!$user->isEmpty() && Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->flash('success', 'Login Successfully!', [
                'position' =>  'top',
                'timer'    =>  1500,
                'toast'    =>  true,
            ]);
            redirect(route('home'));
        } else {
            $this->alert('error', 'Your credentials does not match!', [
                'position' =>  'top',
                'timer'    =>  1500,
                'toast'    =>  true,
            ]);
        }
    }
}
