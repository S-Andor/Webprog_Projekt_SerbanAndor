<?php

namespace App\Http\Controllers;

use App\Interfaces\IUsersRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private IUsersRepository $usersRepository;
    public function __construct(IUsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }
    public function index(){
        $users = User::all();
        return response()->json($users);
    }
    public function login(Request $request){
        return response()->json($this->usersRepository->login($request->get('email'),$request->get('password')));
    }
    public function checkToken(Request $request){
        return response()->json($this->usersRepository->checkToken($request->get('id'),$request->get('token')));
    }
    public function register(Request $request){
        return response()->json($this->usersRepository->register($request->get('email'),$request->get('password')));
    }
}
