<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        // $users = [
        //     [
        //         'id'=>1,
        //         'name' => 'John Doe',
        //         'email'=>'john@example.com',
        //         'is_verified'=>true,
        //     ],
        //     [
        //         'id'=>2,
        //         'name' => 'Jane Doe',
        //         'email'=>'jane@example.com',
        //         'is_verified'=>false,
        //     ]];
        
        
        //Using User models from app/Models/Users
        // $users = User::get()->all();
        $users = User::when($request->name,function($query,$name){
            return $query->where('name',$name);
        })
        ->when($request->email,function($query,$email){
            return $query->orWhere('email',$email);
        })
        ->get();
        //API should return to json, so should convert to json. Also can change status codes with this method
        return response()->json($users,201);
    }

    public function store(UserStoreRequest $request){
        $user = User::create($request->all());
        return response()->json($user,201);
    }

    // public function show($id){
    //     $user=User::findOrFail($id);
    //     return response()->json($user,200);
    // }
    public function show(User $user){
        return response()->json($user,200);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user,200);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user ->delete();
        return response()->json(
            ['message'=>'User deleted successfully'],
            200);
    }

    public function login(Request $request){
        $request ->validate([
            'email'=>'required',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json(['message'=>'The provided credentials are incorrect'],401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'Logged in',
            'token'=>$token
        ], 200);
    }
}
