<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = [
            [
                'id'=>1,
                'name' => 'John Doe',
                'email'=>'john@example.com',
                'is_verified'=>true,
            ],
            [
                'id'=>2,
                'name' => 'Jane Doe',
                'email'=>'jane@example.com',
                'is_verified'=>false,
            ]];
        //API should return to json, so should convert to json. Also can change status codes with this method
        return response()->json($users,201);
    }

    public function store(UserStoreRequest $request){
        $user = $request->all();
        return response()->json($user,201);
    }
}
