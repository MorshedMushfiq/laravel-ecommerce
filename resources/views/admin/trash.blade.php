<x-adminheader title="Trash Data"/>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a class='btn btn-warning btn-sm my-2' href="{{route('all.products')}}">Back</a>
                    <p class="card-title mb-0">Trash Products</p>
                    @if(Session::has("success"))
                    <p class='alert alert-success my-2'>{{Session::get("success")}} <button class='close' data-dismiss="alert">&times;</button> </p>

                    @endif
                  

                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Category</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($all_trash_products as $trash_products)
                        @php
                            $i++;
                        @endphp
                        <tr>
                          <td>{{$trash_products->title}}</td>
                          <td><img src="{{URL::asset('uploads/products/'.$trash_products->image)}}" alt=""></td>
                          <td class="font-weight-bold">${{$trash_products->price}}</td>
                          <td class="font-weight-medium">{{$trash_products->quantites}}</td>
                          <td class="font-weight-medium"><div class="badge badge-success">{{$trash_products->category}}</div></td>
                          <td class="font-weight-medium"><div class="badge badge-warning">{{$trash_products->type}}</div></td>
                          <td>
                            <a href="{{route('products.restore', $trash_products->id)}}" class='btn btn-warning btn-sm'>Restore</a>
                            <a href="{{route('products.delete', $trash_products->id)}}" class='btn btn-danger btn-sm'>Delete Permanently</a>
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

