<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\SUpport\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class MainController extends Controller
{

    //main page with updated products.

    public function index(){
        $allProduct = Product::all();
        $newArrival = Product::where("type", "new-arrivals");
        $hotSales = Product::where("type", "hot-sales");
        return view('index', compact('allProduct', 'newArrival', 'hotSales'));
    }

    //about page
    public function about(){
        return view('about');
    }


    //blog page
    public function blog(){
        return view('blog');
    }

    //single blog page
    public function singleBlog(){
        return view('singleBlog');
    }

    
    //shop page
    public function shop(){
        return view('shop');
    }

    
    //single product page
    public function singleShop($id){
        $singleProduct = Product::find($id);
        return view('singleShop', compact('singleProduct'));
    }

    
    //cart method
    public function cart(){
        $cart_items = DB::table("products")->join("carts", "carts.productId", "products.id")->select("products.title", "products.quantites as pQuantity", "products.price" , "products.image", "carts.*")->where("carts.customerId", Session::get("id"))->get();
        return view('shopping_cart', compact("cart_items"));
    }


    //contact page
    public function contact(){
        return view('contact');
    }


    //register page
    public function register(){
        return view('register');
    }

    // register any user method
    public function registerUser(Request $request){
        //validation 
        $this->validate($request, [
            "email" => ["unique:users"],
        ]);

        //image unique name generation.
        if($request->hasFile('file')){
            $img = $request->file('file');
            $unique_name = md5(time().rand().".". $img->getClientOriginalExtension());
            $img->move(public_path("uploads/profiles"), $unique_name);
        }
        //for register in database
        $user = new User;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->image = $unique_name;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('main.login')->with("success", "Congratulations $request->fullname, Your Account is ready, Sign in for your Dashboard");
        
    }

    //login page
    public function login(){
        return view('login');
    }

    //login any user.
    public function loginUser(Request $request){
        //finding user email and password
        $user = User::where("email", $request->input('email'))->where("password", $request->input('password'))->first();
        //if user exists
        if($user){
            if($user->status=="Block"){
                return redirect()->route('main.login')->with("error", "You are block from admin, Please contact the admin");
            }
            //we just hold the user id and type.
            Session::put('id', $user->id);
            Session::put('type', $user->type);
            //if type of a man is customer
            if($user->type=="Customer"){
                return redirect()->route("main.index");  
            }elseif($user->type=="Admin"){
            //if type of a man is admin  
            return redirect()->route("admin.index"); 

            }
        }else{
            return redirect()->route('main.login')->with("error", "Sorry, Your Email/Password is incorrect");
        }
    }

    //logout method
    public function logoutUser(){
        Session::forget("id");
        Session::forget("type");
        return redirect()->route('main.login')->with("success", "Logout Successfully!!");
    }

    //add to cart method
    public function addCart(Request $request){
        if(Session::has("id")){
            $item = new Cart;
            $item->productId = $request->id;
            $item->quantites = $request->quantity;
            $item->customerId = Session::get('id');
            $item->save();
            return redirect()->route('main.cart')->with("success", "Product add to cart successfull!!");
        }else{
            return redirect()->route('main.login')->with("error", "Please login to add this in your cart!!");
        }
    }

    //delete cart item
    public function deleteCart($id){
        $delete_cart = Cart::find($id);
        $delete_cart->delete();
        return redirect()->back()->with("success", "Cart has been deleted successfull");
    }

    //update cart items quantites
    public function updateCart(Request $request){
        if(Session::has("id")){
            $item = Cart::find($request->id);
            $item->quantites = $request->quantity;
            $item->save();
            return redirect()->route('main.cart')->with("success", "Cart Updated successfull!!");
        }else{
            return redirect()->route('main.login')->with("error", "Please login to add this in your cart!!");
        }
    }


    //check out process
    public function checkout(Request $request){
        if(Session::has("id")){
            $order = new Order;
            $order->status = "pending";
            $order->customerId = Session::get('id');
            $order->bill = $request->bill;
            $order->fullname = $request->fullname;
            $order->cell = $request->cell;
            $order->address = $request->address;
            if($order->save()){
                $carts = Cart::where("customerId", Session::get('id'))->get();
                foreach($carts as $item){
                    $products = Product::find($item->productId);
                    $orderItem = new OrderItem;
                    $orderItem->productId = $item->productId;
                    $orderItem->quantites = $item->quantites;
                    $orderItem->price = $products->price;
                    $orderItem->orderId = $order->id;
                    $orderItem->save();
                    $item->delete();
                }
            }else{
                return redirect()->route('main.cart')->with("success", "Your order has not been placed!!");
            }
            return redirect()->route('main.cart')->with("success", "Your order has been placed successfull!!");

        }else{
            return redirect()->route('main.login')->with("error", "Please login to add this in your cart!!");
        }
    }

    //payment method stripe
    public function paymentStripe(Request $request){
        $bill = $request->bill;
        $fullname = $request->fullname;
        $cell = $request->cell;
        $address = $request->address;
        

        if(Session::has("id")){
            $order = new Order;
            $order->status = "Paid";
            $order->customerId = Session::get('id');
            $order->bill = $request->bill;
            $order->fullname = $request->fullname;
            $order->cell = $request->cell;
            $order->address = $request->address;
                        
          
            
            if($order->save()){
                $carts = Cart::where("customerId", Session::get('id'))->get();

                foreach($carts as $item){
                    $products = Product::find($item->productId);
                    $orderItem = new OrderItem;
                    $orderItem->productId = $item->productId;
                    $orderItem->quantites = $item->quantites;
                    $orderItem->price = $products->price;
                    $orderItem->orderId = $order->id;
                    $orderItem->save();
                    $item->delete();
            //payment system
            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' =>[[
                    'price_data' => [
                        'currency' => 'usd',
                        
                        'product_data' => [
                            'name' =>'Tshirt',
                        ],
                        "unit_amount" => $bill*100,
                    ],
                    "quantity" =>1,
                    
                ]],
                'mode' => 'payment',
                'success_url' => route('main.cart'),
                'cancel_url' => route('main.contact'),
            ]);

                    //dd($checkout_session);

                    return redirect()->away($checkout_session->url);
                    

                }
                 

                return redirect()->route('main.cart')->with("success", "Your order has been placed!!");

            }else{
                return redirect()->route('main.cart')->with("success", "Your order has not been placed!!");
            }
            return redirect()->route('main.cart')->with("success", "Your order has been placed successfull!!");

        }else{
            return redirect()->route('main.login')->with("error", "Please login to add this in your cart!!");
        }


    }

    //user profile
    public function profile(){
        if(Session::has('id')){
            $user = User::find(Session::get('id'));
            return view("profile", compact("user"));
        }else{
            
            return redirect()->route('main.login')->with('error', 'pleasee login to get access to your account');
        }
        
    }

    // user orders
    public function orders(){
        if(Session::has('id')){
            $orders = Order::where('customerId',Session::get('id'))->get();

            $all_order_products = DB::table("products")->join("order_items", "order_items.productId", 'products.id')->select("products.title", "products.image", 'products.description', 'order_items.*')->get();
            
            return view("orders", compact("orders", "all_order_products"));
        }else{
            
            return redirect()->route('main.login')->with('error', 'pleasee login to get access to your account');
        }
        
    }




    //update user info
    public function updateUser(Request $request){
        //image unique name generation.
        if($request->hasFile('file')){
            $img = $request->file('file');
            $unique_name = md5(time().rand().".". $img->getClientOriginalExtension());
            $img->move(public_path("uploads/profiles"), $unique_name);
        }
        //for register in database
        $user = User::find(Session::get('id'));
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->image = $unique_name;
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with("success", "Congratulations $request->fullname, Your Account is Updated");
    }

    //google login
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    
    //google login callback method
    public function googleCallback(){
        try{
            $user = Socialite::driver('google')->user();
            $find_user = User::where('email', $user->email)->first();
            if(!$find_user){
                $find_user = new User;
                $find_user->fullname = $user->name;
                $find_user->email = $user->email;
                $find_user->image = $user->avatar;
                $find_user->password = "12345678";
                $find_user->type = "Customer";
                $find_user->status = "Active";
                $find_user->save();
            }

            Session::put('id', $find_user->id);
            Session::put('type', $find_user->type);
            return redirect('/');

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }


    
    
}
