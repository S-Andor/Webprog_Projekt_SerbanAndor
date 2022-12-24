<?php

namespace App\Interfaces;

interface IUsersRepository
{
    public function login($email,$password);
    public function checkToken($id, $token);
}
