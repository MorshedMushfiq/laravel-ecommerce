{{-- header part shows via component --}}
<x-header title="My Orders | Fashion E-commerce" description="my orders Page of fashion ecommerce" keywords='my orders ecommerce multirole client'/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="section-title">
                <h2>My account</h2>
                <span>My Orders History</span>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 mx-auto">
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total Bill</th>
                                <th>Name</th>
                                <th>Cell Number</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>View Product</th>
                            </tr>
                        </thead>
                        @php
                         $i=0;   
                        @endphp
                        <tbody>
                            @foreach($orders as $items)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <th>
                                    {{$i}}
                                </th>
                                <th>${{$items->bill}}</th>
                                <th>{{$items->fullname}}</th>
                                <th>{{$items->cell}}</th>
                                <th>{{$items->address}}</th>
                                <th>{{$items->status}}</th>
                                <th>{{$items->created_at}}</th>
                                <th>

                            <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$i}}">
                            Products
                        </button>
  
                                <!-- The Modal -->
                                <div class="modal" id="myModal{{$i}}">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Modal Heading</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product Image</th>
                                                        <th>Product Title</th>
                                                        <th>Price</th>
                                                        <th>Quantites</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($all_order_products as $product)
                                                   @if($items->id == $product->orderId)
                                                    <tr>
                                                        <td><img style='width: 100px;' src="{{URL::asset("uploads/products/". $product->image)}}" alt=""></td>
                                                        <td>{{$product->title}}, {{$product->orderId}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->quantites}}</td>
                                                        <td>{{$product->price * $product->quantites}}</td>
                                                    </tr>
                                                   @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                
                                    </div>
                                    </div>
                                </div>

                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
{{-- footer part shows via component --}}
<x-footer />
