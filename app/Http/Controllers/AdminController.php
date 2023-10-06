<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    //admin page, and condition that anyone can't enter the dashboard except admin.
    public function index(){
        if(Session::get('type')=="Admin"){
            return view('admin.index');
        }
        return redirect()->back();
    }

    //admin profile
    public function adminProfile(){
        if(Session::get('type')=="Admin"){
            $admin_user = User::find(Session::get('id'));
            return view('admin.profile', compact("admin_user"));
        }
        return redirect()->back();
    }


    //customers information in dashboard
    public function customers(){
        if(Session::get('type')=="Admin"){
            $customers = User::where("type", "Customer")->get();
            return view('admin.customers', compact("customers"));
        }
        return redirect()->back();
    }

    //products information in dashboard
    public function products(){
        if(Session::get('type')=="Admin"){
        $all_products = Product::all();
        
        return view('admin.products', compact('all_products'));
        }
        return redirect()->back();
    }

    //admin can change user status
    public function changeUserStatus($status, $id){
        if(Session::get('type')=="Admin"){
        $user = User::find($id);
        $user->status = $status;
        $user->save();
        
        return redirect()->back()->with("success", "User Status Updated Successfull!!");
        }
        return redirect()->back();
    }


    // order status (confirm, completed etc)
    public function changeOrderStatus($status, $id){
        if(Session::get('type')=="Admin"){
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
        
        return redirect()->back()->with("success", "Order Status Updated Successfull!!");
        }
        return redirect()->back();
    }



    //products trash method
    public function trash($id){
        if(Session::get('type')=="Admin"){
        $trash_products = Product::withTrashed()->find($id);
        $trash_products->delete();
        
        return redirect()->route("all.trash")->with("success", "Product Trashed Successfull!!");
        }
        return redirect()->back();
    }

    //trash page
    public function trashPage(){
        if(Session::get('type')=="Admin"){
        $all_trash_products = Product::onlyTrashed()->get();
        return view("admin.trash", compact("all_trash_products"));
        }
        return redirect()->back();
    }

    //restore product data
    public function restore($id){
        if(Session::get('type')=="Admin"){
        $trash_products = Product::withTrashed()->find($id);
        if(!is_null($trash_products)){
            $trash_products->restore();
        }
        
        return redirect()->route('all.products')->with("success", "Product Data Restore Successfull!!");
        }
        return redirect()->back();
    }

    //delete permanently product data
    public function forceDelete($id){
        if(Session::get('type')=="Admin"){
        $trash_products = Product::withTrashed()->find($id);
        
        if(!is_null($trash_products)){
            $trash_products->forceDelete();
        }
        
        return redirect()->route("all.trash")->with("success", "Product Delete permanently Successfull!!");
        }
        return redirect()->back();
    }


    //upload new product
    public function upload(Request $request){
        if(Session::get('type')=="Admin"){
            //image unique name generation.
            if($request->hasFile('image')){
                $img = $request->file('image');
                $unique_name = md5(time().rand().".". $img->getClientOriginalExtension());
                $img->move(public_path("uploads/products"), $unique_name);
            }

            $product = new Product;
            $product->title=$request->title;
            $product->image=$unique_name;
            $product->description=$request->description;
            $product->keywords=$request->keywords;
            $product->price=$request->price;
            $product->quantites=$request->quantity;
            $product->category=$request->category;
            $product->type=$request->type;
            $product->save();
            return redirect()->back()->with("success", "New Product Listed Successfull!!");
        }
        return redirect()->back();
    }

    //update product
    public function updateProduct(Request $request){
        if(Session::get('type')=="Admin"){
        //image unique name generation.
        if($request->hasFile('image')){
            $img = $request->file('image');
            $unique_name = md5(time().rand().".". $img->getClientOriginalExtension());
            $img->move(public_path("uploads/products"), $unique_name);
        }

        $product = Product::find($request->id);
        $product->title=$request->title;
        if(!empty($unique_name)){
            $product->image=$unique_name;
        }
        $product->description=$request->description;
        $product->keywords=$request->keywords;
        $product->price=$request->price;
        $product->quantites=$request->quantity;
        $product->category=$request->category;
        $product->type=$request->type;
        $product->save();
        return redirect()->back()->with("success", "Product List Updated Successfull!!");
        }
        return redirect()->back();
    }

    //all orders method to get the full order and products info.
    public function allOrders(){
        if(Session::get('type')=="Admin"){
            
            $order_items = DB::table('order_items')->join('products', 'order_items.productId', 'products.id')->select('products.title', 'products.image', 'order_items.*')->get();

            $all_orders = DB::table('users')->join('orders', 'orders.customerId', 'users.id')->select('orders.*', 'users.fullname', 'users.email', 'users.status as userStatus')->get();
            return view('admin.order', compact('all_orders', 'order_items'));
        }
        return redirect()->back();    
    }
}
