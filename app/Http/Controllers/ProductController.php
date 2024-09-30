<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GadgetModel;
class ProductController extends Controller
{
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
