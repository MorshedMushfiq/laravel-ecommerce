<x-adminheader title="Orders"/>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Our Orders</p>

                    @if(Session::has("success"))
                    <p class='alert alert-success my-2'>{{Session::get("success")}} <button class='close' data-dismiss="alert">&times;</button> </p>

                    @endif
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#.</th>
                          <th>Customer</th>
                          <th>E-mail</th>
                          <th>Customer Status</th>
                          <th>Bill</th>
                          <th>Cell</th>
                          <th>Address</th>
                          <th>Order Date</th>
                          <th>Products</th>
                          <th>Order Status</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($all_orders as $orders)
                        @php
                            $i++;
                        @endphp
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$orders->fullname}}</td>
                          <td class="font-weight-bold">{{$orders->email}}</td>
                          <td class="font-weight-medium">{{$orders->userStatus}}</td>
                          <td>{{$orders->bill}}</td>
                          <td>{{$orders->cell}}</td>
                          <td>{{$orders->address}}</td>
                          <td>{{$orders->created_at}}</td>
                          <td>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatemodal{{$i}}">
                              Products
                              </button>  
  
                               <!-- The Modal -->
                      <div class="modal" id="updatemodal{{$i}}">
                          <div class="modal-dialog">
                              <div class="modal-content">
                      
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                  <h4 class="modal-title">Order Products</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                          
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                      <table>
                                        <thead>
                                          <tr>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($order_items as $orders_item)
                                          @if($orders_item->orderId==$orders->id)
                                          <tr>
                                            <td>{{$orders_item->title}}</td>
                                            <td><img src="{{URL::to('uploads/products/'. $orders_item->image)}}" alt=""></td>
                                            <td>{{$orders_item->price}}</td>
                                            <td>{{$orders_item->quantites}}</td>
                                            <td>{{$orders_item->price * $orders_item->quantites}}</td>
                                          </tr>
                                          @endif
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                      
                              </div>
                          </div>
                      </div>





                          </td>
                          <td>{{$orders->status}}</td>
                          <td>
                            @if($orders->status=="Paid")
                            <a href="{{URL::to('orders/Accept', $orders->id)}}" class='btn btn-success btn-sm'>Accept</a>  
                            <a href="{{URL::to('orders/Reject', $orders->id)}}" class='btn btn-danger btn-sm'>Reject</a> 
                            @elseif($orders->status=="Accept")
                            <a href="{{URL::to('orders/Delievred', $orders->id)}}" class='btn btn-success btn-sm'>Completed</a>
                            @elseif($orders->status=="Delievred")
                            Already Accepted.
                            @else
                            <a href="{{URL::to('orders/Accept', $orders->id)}}" class='btn btn-success btn-sm'>Accept</a>
                            @endif
                          </td>


                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->


<x-adminfooter />

