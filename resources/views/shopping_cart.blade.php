{{-- header part shows via component --}}
<x-header title="Shopping Cart | Fashion E-commerce" description="Shopping cart Page of fashion ecommercer" keywords='home ecommerce multirole client'/>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        @if(Session::has('success'))
                        <p class='alert alert-success'>{{Session::get("success")}} <button class='close' data-dismissed='alert'>&times;</button> </p>

                        @endif
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;    

                                @endphp
                                @foreach($cart_items as $items)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{URL::asset('uploads/products/'.$items->image)}}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$items->title}}</h6>
                                            <h5>{{$items->price}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <form action="{{route('update.cart', $items->id)}}" method="POST">
                                            @csrf
                                            <div class="quantity">
                                                <input type="number" name='quantity' min='1' max="{{$items->pQuantity}}" value="{{$items->quantites}}">
                                            </div>
                                            <input type="hidden" name='id' value="{{$items->id}}">
                                            <input type="submit" class='btn btn-success' value="Update">
                                        </form>
                                    </td>
                                    <td class="cart__price">${{$items->price * $items->quantites}}</td>
                                    <td class="cart__close"><a href="{{route('delete.cart', $items->id)}}"><i class="fa fa-close"></i></a></td>
                                </tr>
                                @php
                                    $total+= ($items->price * $items->quantites);
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{$total}}</span></li>
                            <li>Total <span>$ {{$total}}</span></li>
                        </ul>
                        <form action="{{URL::to('/payment')}}" method="POST">
                            @csrf
                            <input type="text" name='fullname' placeholder="Enter your full name" class='form-control mt-2' required>
                            <input type="text" name='cell' placeholder="Enter your cell number" class='form-control mt-2' required>
                            <input type="text" name='address' placeholder="Enter your full address" class='form-control mt-2' required>
                            <input type="hidden" name='bill' value="{{$total}}">
                            <button type="submit" class="primary-btn mt-2 btn btn-block">Proceed to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    
{{-- footer part shows via component --}}
<x-footer />






{{-- 
    
    

    
    
    
    
    
    --}}