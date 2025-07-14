<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $users = Product::when($request->name,function($query,$name){
            return $query->where('name',$name);
        })
        ->when($request->email,function($query,$email){
            return $query->orWhere('email',$email);
        })
        ->get();
        //API should return to json, so should convert to json. Also can change status codes with this method
        return response()->json($users,201);
    }

    public function store(ProductStoreRequest $request){
        $user = Product::create($request->all());
        return response()->json($user,201);
    }

    // public function show($id){
    //     $user=User::findOrFail($id);
    //     return response()->json($user,200);
    // }
    // public function show(User $user){
    //     return response()->json($user,200);
    // }

    // public function update(Request $request, $id){
    //     $user = User::findOrFail($id);
    //     $user->update($request->all());
    //     return response()->json($user,200);
    // }

    public function destroy($id){
        $user = Product::findOrFail($id);
        $user ->delete();
    return response()->json(
            ['message'=>'Product deleted successfully'],
            200);
    }
}
