<?php


namespace App\Services\Api;


use App\User;

class UsersService
{
    public function getUsers()
    {
        return User::all();
    }

    public function update(User $user)
    {
        $user->update(request(['password','type']));
        return $user;
    }

    public function counts()
    {
        return User::count();
    }
}
