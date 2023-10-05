<x-adminheader title="Products"/>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#addnewmodal">
                        Add New Product
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="addnewmodal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Add New Product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{route('upload.product')}}" method='POST' enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Product Title:</label>
                                            <input type="text" name='title' placeholder='New Product Name' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Image:</label>
                                            <input type="file" name='image' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Description:</label>
                                            <textarea type="text" name='description' placeholder='New Product Description' class='form-control'></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Keywords:</label>
                                            <textarea type="text" name='keywords' placeholder='New Product Keywords' class='form-control'></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Price:</label>
                                            <input type="text" name='price' placeholder='New Product Price' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Quantity:</label>
                                            <input type="number" name='quantity' placeholder='Enter Quantity' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Category:</label>
                                            <select name="category" class='form-control' id="">
                                                <option value="uncategory">Select Category</option>
                                                <option value="Accessories">Accessories</option>
                                                <option value="Clothes">Clothes</option>
                                                <option value="Shoes">Shoes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Type:</label>
                                            <select name="type" class='form-control' id="">
                                                <option value="unselect">Select Type</option>
                                                <option value="Best Seller">Best Seller</option>
                                                <option value="new-arrivals">new-arrivals</option>
                                                <option value="hot-sales">hot-sales</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value='Upload Product' class='btn btn-info'>
                                        </div>
                                    </form>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    @if(Session::has("success"))
                    <p class='alert alert-success my-2'>{{Session::get("success")}} <button class='close' data-dismiss="alert">&times;</button> </p>

                    @endif
                    <a class='btn btn-info btn-sm' href="{{route('all.trash')}}">Trash</a>
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
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
                        @foreach($all_products as $products)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                          <td>{{$products->title}}</td>
                          <td><img src="{{URL::asset('/storage/uploads/products/'.$products->image)}}" alt=""></td>
                          <td class="font-weight-bold">${{$products->price}}</td>
                          <td class="font-weight-medium">{{$products->quantites}}</td>
                          <td class="font-weight-medium"><div class="badge badge-success">{{$products->category}}</div></td>
                          <td class="font-weight-medium"><div class="badge badge-warning">{{$products->type}}</div></td>
                          <td>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatemodal{{$i}}">
                            Update
                            </button>  

                             <!-- The Modal -->
                    <div class="modal" id="updatemodal{{$i}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Update Product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{route('update.product', $products->id)}}" method='POST' enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Product Title:</label>
                                            <input type="text" value="{{$products->title}}" name='title' placeholder='New Product Name' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Image:</label>
                                            <input type="file" name='image' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Description:</label>
                                            <textarea type="text" name='description' placeholder='New Product Description' class='form-control'>{{$products->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Keywords:</label>
                                            <textarea type="text" name='keywords' placeholder='New Product Keywords' class='form-control'>{{$products->keywords}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Price:</label>
                                            <input type="text" value="{{$products->price}}"  name='price' placeholder='New Product Price' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Quantity:</label>
                                            <input type="number" name='quantity' value="{{$products->quantites}}" placeholder='Enter Quantity' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Category:</label>
                                            <select name="category" class='form-control' id="">
                                                <option value="{{$products->category}}" >{{$products->category}}</option>
                                                <option value="Accessories">Accessories</option>
                                                <option value="Clothes">Clothes</option>
                                                <option value="Shoes">Shoes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Type:</label>
                                            <select name="type" class='form-control' id="">
                                                <option value="{{$products->type}}" >{{$products->type}}</option>
                                                <option value="Best Seller">Best Seller</option>
                                                <option value="new-arrivals">new-arrivals</option>
                                                <option value="hot-sales">hot-sales</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value='Update Product' class='btn btn-info'>
                                        </div>
                                    </form>
                                </div>
                    
                            </div>
                        </div>
                    </div>

                            <a href="{{route('trash.product', $products->id)}}" class='btn btn-danger btn-sm'>Trash</a>
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

