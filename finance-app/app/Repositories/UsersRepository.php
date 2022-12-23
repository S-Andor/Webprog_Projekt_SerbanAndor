<?php

namespace App\Repositories;

use App\Interfaces\IUsersRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersRepository implements IUsersRepository
{

    public function login($email, $password)
    {
        return DB::table('users')
            ->where('email','=',$email)
            ->where('password','=',$password);
    }
}
