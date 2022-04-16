<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $focusedUser;
    public $focusedUserRoleId;
    public $email_confirmation, $email;

    public $dir      = 'asc';
    public $search   = '';
    public $perPage  = 10;
    public $orderBy  = 'name';
    public $openEdit = false;

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orderBy($this->orderBy, $this->dir)
                    ->paginate($this->perPage);
    
        return view('livewire.admin.users.index', [
                    'users' => $users,
            ])->layout('layouts.admin', [
                'title'     => 'Usuarios',
                'pageName'  => 'Usuarios'
        ]);
    }

    public function rules()
    {
        $rules = [
            'focusedUser.name'      => ['required'],
            'focusedUser.role_id'   => ['required', 'exists:roles,id'],
        ];

        if (!is_null($this->focusedUser)){
            $this->focusedUser->role_id = $this->focusedUserRoleId 
                                            ? \App\Models\Role::ADMIN  
                                            : \App\Models\Role::USER;

            $rules['email'] = ['required', 'email', 'confirmed', 'unique:users,email,'. $this->focusedUser->id];
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editModal(int $userId)
    {
        $this->focusedUser        = User::findOrfail($userId);
        $this->email              = $this->focusedUser->email;
        $this->email_confirmation = $this->focusedUser->email;
        $this->openEdit  = true;
    }

    public function updateUser()
    {
        $this->validate();
        $this->focusedUser->email = $this->email;
        $this->focusedUser->save();
        $this->resetData();
    }

    public function resetData() :void
    {
        $this->reset(['focusedUser', 'openEdit', 'email', 'email_confirmation']);
        $this->resetValidation();
    }

    public function order($field)
    {
        if ($this->orderBy == $field) {
            $this->dir = $this->dir == 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->dir = 'asc';
        }
    }

    public function changeStatus(int $userId):void 
    {
        try {
            $user = User::findOrfail($userId);

            $user->update([
                'status' => ! boolval($user->status)
            ]);
            $this->emit('nice', 'Estado modificado con exito.');
        } catch (\Exception $e) {
            $this->emit('error', 'Ha ocurrido un error. Intenta luego.');
        }
    }
}
