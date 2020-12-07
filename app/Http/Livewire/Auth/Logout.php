<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.auth.logout');
    }

    public function logout()
    {
        Auth::logout();
        $this->flash('success', 'Logout successfully!', [
            'position'          =>  'top',
            'timer'             =>  1500,
            'toast'             =>  true,
        ]);
        redirect(route('login'));
    }
}
