<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
        public function index(){
            $tasks = [
                [
                    'id'=>1,
                    'topic' => 'Learning Laravel',
                    'description'=>'Make a todo list',
                ],
                [
                    'id'=>2,
                    'topic' => 'Learning NodeJS',
                    'description'=>'Make user authentication and session',
                ]];
            //API should return to json, so should convert to json. Also can change status codes with this method
            return response()->json($tasks,201);
    }
}
