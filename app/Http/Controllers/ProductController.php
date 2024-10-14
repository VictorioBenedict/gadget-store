<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GadgetModel;
use App\Models\UserModel;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = GadgetModel::where('name', 'LIKE', "%{$query}%")->paginate(4);
        $count = GadgetModel::count();
        $date = now()->format('Y-m-d');
    
        return view('dashboard', compact('products', 'count', 'date', 'query'));
    }

    public function searchuser(Request $request)
    {
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'role') // Include necessary columns including 'id'
        ->where('role', '!=', 'admin') // Exclude users with the 'admin' role
        ->where(function($queryBuilder) use ($query) {
            if ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                             ->orWhere('email', 'LIKE', "%{$query}%");
            }
        })
        ->paginate(4);
        $userCount = UserModel::where('role', '!=', 'admin')->count(); 
        $adminCount = UserModel::where('role', 'admin')->count(); 
        $count = $users->total(); 
    
        return view('users', compact('users', 'query', 'userCount', 'adminCount', 'count'));
    }
    public function searchadmin(Request $request){
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'role') // Include necessary columns including 'id'
            ->where('role', 'admin') // Filter to include only admin users
            ->where(function($queryBuilder) use ($query) {
                if ($query) {
                    $queryBuilder->where('name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%");
                }
            })
            ->paginate(4);

        $userCount = UserModel::where('role', '!=', 'admin')->count(); 
        $adminCount = UserModel::where('role', 'admin')->count(); 
        $count = $users->total(); 

        return view('admins', compact('users', 'query', 'userCount', 'adminCount', 'count'));

    }
    
    
    
    
    
    public function products(Request $request){
        $query = $request->input('query');
        $category = $request->input('category');

        $product = GadgetModel::query()
            ->when($category, function ($queryBuilder) use ($category) {
                $queryBuilder->where('category', $category);
            })
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->get();

        return view('products', compact('product', 'query', 'category'));
    }
    public function all(Request $request)
    { 
        $query = $request->input('query');
        $product= GadgetModel::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->get();
        
        return view('products', compact('product', 'query'));
    }

    public function smartphonee(Request $request)
    {
        $query = $request->input('query');
        $product = GadgetModel::where('category','smartphone')->get();
        return view("products", compact("product", 'query'));
    }


    public function digitalcameraa(Request $request)
    {
        $query = $request->input('query');
        $product = GadgetModel::where('category','digitalcamera')->get();
        return view("products", compact("product",'query'));
    }

    public function personalcomputerr(Request $request)
    {
        $query = $request->input('query');
        $product = GadgetModel::where('category','personalcomputer')->get();
        return view("products", compact("product",'query'));
    }

    public function televisionn(Request $request)
    {
        $query = $request->input('query');
        $product = GadgetModel::where('category','television')->get();
        return view("products", compact("product",'query'));
    }
}
