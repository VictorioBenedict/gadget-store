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
            $user = Auth::user();
        
        return view('index', compact('product', 'query','loggedInUser','user'));
    }


    public function smartphone(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','smartphone')->get();
        $user = Auth::user();
        return view("index", compact("product", 'query','loggedInUser','user'));
    }

    
    public function digitalcamera(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','digitalcamera')->get();
        $user = Auth::user();
        return view("index", compact("product",'query','loggedInUser','user'));
    }

    public function personalcomputer(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','personalcomputer')->get();
        $user = Auth::user();
        return view("index", compact("product",'query','loggedInUser','user'));
    }

    public function television(Request $request)
    {
        $loggedInUser = Auth::user()->name ?? null;
        $query = $request->input('query');
        $product = GadgetModel::where('category','television')->get();
        $user = Auth::user();
        return view("index", compact("product",'query','loggedInUser','user'));
    }

    public function dashboard(Request $request){
        $query = $request->input('query');
        $date = Carbon::now()->format('d-m-y'); 
        $products = GadgetModel::paginate(4); 
        $notification =  Order::where('created_at','>=',now()->subHour())->count();
        $count = $products->total(); 
        return view("dashboard", compact('products', 'count', 'date','query','notification'));
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
            'image' => 'nullable|image|max:2048', 
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images'), $imageName); 
        } else {
            $imageName = null; 
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
        $user = Auth::user();
        $loggedInUser = Auth::user()->name ?? null;
        $cart = session()->get('cart', []);
        return view('cart',compact('cart','loggedInUser','user'));
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

    $cart = $request->session()->get('cart'); 
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
        $loggedInUser = Auth::user(); // Get the user object
        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            $cartItem = new Order();
            $cartItem->user_id = Auth::id(); //para kunin yung user_id sa model tas ipasa ma identify kung kanino yung order
            $cartItem->product_id = $productId;
            $cartItem->user_name = $loggedInUser->name; // Store the user's name
            $cartItem->name = $item['name'];
            $cartItem->quantity = $item['quantity'];
            $cartItem->price = $item['price'];
            $request->session()->forget('cart'); 
            $cartItem->save();
        }
        return redirect()->route('order')->with([
            'success' => "Happy Purchasing, {$loggedInUser->name}!",
            'username' => $loggedInUser->name,
            'loggedInUser' => $loggedInUser // Pass the user object to the view
        ]);
    }
    public function checkout(Request $request){
        $loggedInUser = Auth::user()->name ?? null;
        $product = GadgetModel::all();
        $query = $request->input('query');
        $user = Auth::user();
        return view("index", compact("product","query","loggedInUser",'user'));
    }

    public function order(Request $request){
        $order = new Order();
        $order->user_id = Auth::id(); 
        $loggedInUser = Auth::user();
        $cartItems = Order::where('user_id', $loggedInUser->id)->get(['id', 'user_id', 'product_id', 'name', 'quantity', 'price', 'status']);
        $loggedInUser = Auth::user()->name ?? null;
        $user = Auth::user();
        $products = Order::all();
        $hasAcceptedStatus = $cartItems->contains(function ($product) {
            return $product['status'] === 'accepted';
        });
        return view('order',compact('cartItems','loggedInUser','user','hasAcceptedStatus'));
    }

    public function orderlist(Request $request){
        $status = $request->input('status', 'pending');

        if($status === 'pending'){
            $orders = Order::where('status','pending')->paginate(4);
        }
        elseif($status === 'accepted'){
            $orders = Order::where('status', 'accepted')->paginate(4);
        }
        elseif($status ==='rejected') {
            $orders = Order::where('status', 'rejected')->paginate(4);
        } 
        else {
            $orders = Order::where('status', 'completed')->paginate(4);
        }
        $notification = Order::where('created_at', '>=', now()->subHour())->count();
        $count = Order::count();
        return view ('orderlist',compact('orders','count','notification'));
    }

    public function customer(){
        $users = UserModel::where('role', 'user')->select('id', 'name','address')->paginate(5);
        $notification = Order::where('created_at', '>=', now()->subHour())->count();
        $count = Order::count();
        return view('customer', compact('users','count','notification'));
    }

    public function customerview(Request $request,$id){
        $user = UserModel::findOrFail($id);
        $orders = Order::where('user_id', $id)->paginate(4);
        $notification = Order::where('created_at', '>=', now()->subHour())->count();
        $count = Order::count();
        return view('customerview', compact('user', 'orders', 'count', 'notification'));

    }

    public function updatestatus(Request $request,$id){
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed',
        ]);
    
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
    
        return redirect()->back()->with('success', 'Order status updated successfully.');
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
        $ordersExist = Order::where('user_id', $userId)->exists();
    
        if ($ordersExist) {
            Order::where('user_id', $userId)->delete();
    
            return redirect()->route('order')->with('success', 'Your orders have been successfully cancelled.');
        } else {
            return redirect()->route('order')->with('success', 'No orders found to cancel.');
        }
    }

    public function deleteorders($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Order has been successfully cancelled.');
    }


}
