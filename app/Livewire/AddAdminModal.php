<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AddAdminModal extends Component
{
    public $admins;

    public User $user;

    public $message = '';

    public $showModal = false;

    #[Validate('required|min:6')]
    public $name;

    #[Validate('required|unique:users,email')]
    public $email;

    #[Validate('required|confirmed|min:8')]
    public $password;

    #[Validate('required')]
    public $password_confirmation;

    public function render()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $this->admins = User::role($adminRole)->get();

        return view('livewire.add-admin-modal');
    }

    public function createAdmin()
    {
        $this->validate();

        $this->user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->user->assignRole('admin');

        $this->message = 'Admin added successfully';

        activity()
            ->performedOn($this->user)
            ->causedBy(Auth::id())
            ->withProperty('name', $this->user->name )
            ->log('New admin account created');

        $this->showModal = false;

    }

    public function deleteAdmin($id)
    {


        $this->user = User::find($id);
        $this->user->removeRole('admin');

        activity()
            ->performedOn($this->user)
            ->causedBy(Auth::id())
            ->withProperty('name', $this->user->name )
            ->log('Admin account removed');

        $this->user->delete();

        $this->message = 'Admin deleted successfully';
    }
}
