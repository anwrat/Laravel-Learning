<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::when($request->title,function($query,$title){
            return $query->where('title',$title);
        })
        ->when($request->description,function($query,$description){
            return $query->orWhere('email',$description);
        })
        ->get();
        //API should return to json, so should convert to json. Also can change status codes with this method
        return response()->json($products,201);
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

    public function update(Request $request, $id){
        $user = Product::findOrFail($id);
        $user->update($request->all());
        return response()->json($user,200);
    }

    public function destroy($id){
        $user = Product::findOrFail($id);
        $user ->delete();
    return response()->json(
            ['message'=>'Product deleted successfully'],
            200);
    }
}
