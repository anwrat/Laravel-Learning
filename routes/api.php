<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('users',function(){
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
});

Route::post('users',function(Request $request){
    //For only sending name
    //return $request->name;
    // return $request->all(); //For returning all key pairs from body
    $request->validate([
        'name' => 'required'
    ]);
    return $request->all(); 
});

Route::put('users/{id}',function(Request $request, $id){
    return $id;
});

?>