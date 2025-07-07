<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('users',[UserController::class,'index']);

Route::post('users',function(Request $request){
    //For only sending name
    //return $request->name;
    // return $request->all(); //For returning all key pairs from body
    $request->validate([
        'name' => 'required|min:3|max:10',
        'email'=>'required_if:name,John',//Email is required only if name is john
    ]);
    return $request->all(); 
});

Route::put('users/{id}',function(Request $request, $id){
    return $id;
});

Route::get('tasks',[TaskController::class,'index']);

?>