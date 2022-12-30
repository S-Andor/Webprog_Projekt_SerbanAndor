<?php

namespace App\Repositories;

use App\Interfaces\IUsersRepository;
use App\Models\User;
use DateTime;
use DateTimeZone;

class UsersRepository implements IUsersRepository
{

    public function login($email, $password)
    {
        $user = User::query()
            ->where('email','=',$email)
            ->where('password','=',$password)
            ->first();

        if (isset($user->id)){

            $token = bin2hex(random_bytes(16));
            $date = new DateTime('now',new DateTimeZone('UTC'));
            $date->modify('+15 minutes');

            User::query()
                ->where('id', $user->id)
                ->update(['token' => $token, 'expiresAt' => $date]);

            return  User::query()
                ->where('id','=',$user->id)
                ->first(['id','token']);

        }
        else{
            return null;
        }

    }

    public function checkToken($id, $token){
        $user = User::query()
            ->where('id','=',$id)
            ->where('token','=',$token)
            ->first();

        if (isset($user->id)){
            $date = new DateTime('now',new DateTimeZone('UTC'));
            $expires =  new DateTime($user->expiresAt,new DateTimeZone('UTC'));
            if ($token == $user->token && $expires > $date){
                return  true;
            }

        }

        return false;
    }

    public function register($email, $password){
        $user = User::query()
            ->where('email','=',$email)
            ->first();

        if (isset($user->id)){
            return false;
        }

        $token = bin2hex(random_bytes(16));
        $date = new DateTime('now',new DateTimeZone('UTC'));
        $expires = $date->modify('+15 minutes');

        $id = User::query()
            ->insertGetId([
                'email' => $email,
                'password' => $password,
                'token' => $token,
                'expiresAt' => $expires,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

        return User::query()
            ->where('id','=',$id)
            ->first(['id','token']);

    }

}
