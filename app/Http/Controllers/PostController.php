<?php

namespace App\Http\Controllers;

use App\Models\GadgetModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostController extends Controller
{
    public function main(){
        return view("main");
    }
    public function index(Request $request)
    { 
        $query = $request->input('query');
        $product= GadgetModel::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->get();

            $loggedInUser = Auth::user()->name ?? null;
        
        return view('index', compact('product', 'query','loggedInUser'));
    }


    public function smartphone(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','smartphone')->get();
        return view("index", compact("product", 'query','loggedInUser'));
    }

    
    public function digitalcamera(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','digitalcamera')->get();
        return view("index", compact("product",'query','loggedInUser'));
    }

    public function personalcomputer(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','personalcomputer')->get();
        return view("index", compact("product",'query','loggedInUser'));
    }

    public function television(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','television')->get();
        return view("index", compact("product",'query','loggedInUser'));
    }

    public function home(Request $request){
        $query = $request->input('query');
        $product= GadgetModel::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->get();
        
        return view('index', compact('product', 'query'));
    }

    public function dashboard(){
        $count = GadgetModel::count();
        $date = Carbon::now()->format('d-m-y'); // Example: 03-12-24
        $product = GadgetModel::all();
        return view("dashboard",compact("product","count","date"));
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Max 2MB, can adjust as needed
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Use file() method to retrieve uploaded file
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate unique image name
            $image->move(public_path('images'), $imageName); // Move image to public/images directory
        } else {
            $imageName = null; // Default image name if no image uploaded
        }

        $product = new GadgetModel();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->image = $imageName; 
        $product->price = $request->price;
        $product->save();
        return redirect()->route('dashboard')->with('success','Successfully Added!');
    }

   
    public function view($id)
    {
        $product = GadgetModel::find($id);
        return view('view', compact('product'));
    }

    public function edit($id)
    {
        $product = GadgetModel::findOrFail($id);
        return view('edit', compact('product'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:65535', // Allow long text input
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'price' => 'required|numeric|min:0',
        ]);
        $product = GadgetModel::findOrFail($id);
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        
        if ($product->image) {
            $oldImagePath = public_path('images/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete the old file from the server
            }
        }
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $product->image = $imageName;

        $product->price = $request->price;
        $product->save();
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

  
    public function destroy($id)
    {
        $product = GadgetModel::findOrFail($id);
       
        if ($product->image) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file from the public/images directory
            }
        }
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
    }
    public function cart(){
        $loggedInUser = Auth::user()->name ?? null;
        $cart = session()->get('cart', []);
        return view('cart',compact('cart','loggedInUser'));
    }

    public function addtocart($id)
    {
    $product = GadgetModel::find($id);

    if (!$product) {
        abort(404); 
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        return redirect()->route('index')->with('error', 'Product has already been added to cart.');
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
        ];
    }
    session()->put('cart', $cart); 
    return redirect()->route('index')->with('success', 'Product successfully added to cart.');
    }


    public function remove($id)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            unset($cart[$id]); // Remove the item from the cart
    
            session()->put('cart', $cart); // Update the cart session key 'cart', not an empty key
        }
    
        return redirect()->route('cart')->with('success', 'Item removed from cart successfully.');
    }

    public function updatequantity($id, Request $request){
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
    
            // Calculate new total for this product
            $newTotal = $cart[$id]['price'] * $request->quantity;
    
            // Calculate new total cart amount
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
    
            return response()->json([
                'product' => $cart[$id],
                'cartTotal' => $total,
            ]);
        }
        return redirect()->route('cart')->with('success', 'Cart Updated Successfully!.');
    }

    public function session(Request $request)
    {
    \Stripe\Stripe::setApiKey(config('stripe.sk'));

    $cart = $request->session()->get('cart'); // Assuming cart details are stored in session
    $total = 0;
    foreach ($cart as $id => $product) {
        $total += $product['price'] * $product['quantity'];
    }
    
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'PHP',
                    'product_data' => [
                        'name' => $product['name'],
                    ],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('success'), 
        'cancel_url' => route('checkout'), 
    ]);
    return redirect()->away($session->url);
    }

 
    public function success(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            $cartItem = new Order();
            $cartItem->user_id = Auth::id(); //para kunin yung user_id sa model tas ipasa ma identify kung kanino yung order
            $cartItem->product_id = $productId;
            $cartItem->name = $item['name'];
            $cartItem->quantity = $item['quantity'];
            $cartItem->price = $item['price'];
            $request->session()->forget('cart'); 
            $cartItem->save();
        }
        return redirect()->route('order')->with('success', "Happy Purchasing, {$loggedInUser}!");
    }
    public function checkout(Request $request){
        $loggedInUser = Auth::user()->name ?? null;
        $product = GadgetModel::all();
        $query = $request->input('query');
        return view("index", compact("product","query","loggedInUser"));
    }

    public function order(Request $request){
        $order = new Order();
        $order->user_id = Auth::id(); 
        $name = Auth::user()->name ?? null;
        $loggedInUser = Auth::user();
        $cartItems = Order::where('user_id', $loggedInUser->id)->get();
        return view('order',compact('cartItems','loggedInUser','name'));
        // Fetch orders associated with the authenticated user
    }

    public function truncateOrders(Request $request) {
        $orderCount = Order::count();
    
        if ($orderCount === 0) {
            return redirect()->route('dashboard')->with('error', 'No orders found to delete.');
        }
    
        Order::truncate();
        return redirect()->route('dashboard')->with('success', 'Orders successfully deleted.');
    }
    

    public function cancelorders(Request $request){
        $userId = Auth::id();

        // Check if orders exist for the authenticated user
        $ordersExist = Order::where('user_id', $userId)->exists();
    
        if ($ordersExist) {
            // Delete orders associated with the authenticated user
            Order::where('user_id', $userId)->delete();
    
            return redirect()->route('order')->with('success', 'Your orders have been successfully cancelled.');
        } else {
            // No orders found to delete, create a message
            return redirect()->route('order')->with('success', 'No orders found to cancel.');
        }
    }

    public function deleteorders($id)
    {
        // Find the order by ID
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Delete the order
        $order->delete();

        return redirect()->back()->with('success', 'Order has been successfully cancelled.');
    }


}
