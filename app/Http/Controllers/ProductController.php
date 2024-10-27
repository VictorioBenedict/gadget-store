<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Exports\ProductExport;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Models\GadgetModel;
use App\Models\UserModel;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = GadgetModel::where('name', 'LIKE', "%{$query}%")->paginate(5);
        $count = GadgetModel::count();
        $date = now()->format('Y-m-d');
        $notification = Order::whereColumn('created_at', 'updated_at')->count();
        return view('dashboard', compact('products', 'count', 'date', 'query','notification'));
    }

    public function searchuser(Request $request)
    {
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'address', 'role') // Include necessary columns including 'id'
        ->where('role', '!=', 'admin') // Exclude users with the 'admin' role
        ->where(function($queryBuilder) use ($query) {
            if ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                             ->orWhere('email', 'LIKE', "%{$query}%");
            }
        })
        ->paginate(5);
        $notification = Order::whereColumn('created_at', 'updated_at')->count();
        $userCount = UserModel::where('role', '!=', 'admin')->count(); 
        $adminCount = UserModel::where('role', 'admin')->count(); 
        $count = $users->total(); 
    
        return view('users', compact('users', 'query', 'userCount', 'adminCount', 'count','notification'));
    }
    public function searchadmin(Request $request){
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'address', 'role') // Include necessary columns including 'id'
            ->where('role', 'admin') // Filter to include only admin users
            ->where(function($queryBuilder) use ($query) {
                if ($query) {
                    $queryBuilder->where('name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%");
                }
            })
            ->paginate(5);
        $notification = Order::whereColumn('created_at', 'updated_at')->count();
        $userCount = UserModel::where('role', '!=', 'admin')->count(); 
        $adminCount = UserModel::where('role', 'admin')->count(); 
        $count = $users->total(); 

        return view('admins', compact('users', 'query', 'userCount', 'adminCount', 'count','notification'));

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

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function userexport()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function orderexport()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}
