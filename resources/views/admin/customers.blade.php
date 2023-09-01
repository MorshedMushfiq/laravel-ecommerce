<x-adminheader title="Customers"/>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Our Customers</p>

                    @if(Session::has("success"))
                    <p class='alert alert-success my-2'>{{Session::get("success")}} <button class='close' data-dismiss="alert">&times;</button> </p>

                    @endif
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#.</th>
                          <th>Fullname</th>
                          <th>Picture</th>
                          <th>E-mail</th>
                          <th>Type</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($customers as $customer)
                        @php
                            $i++;
                        @endphp
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$customer->fullname}}</td>
                          <td><img src="{{URL::asset('uploads/profiles/'.$customer->image)}}" alt=""></td>
                          <td class="font-weight-bold">{{$customer->email}}</td>
                          <td class="font-weight-medium">{{$customer->type}}</td>
                          <td class="font-weight-medium"><div class="badge badge-success">{{$customer->created_at}}</div></td>
                          <td class="font-weight-medium"><div class="badge badge-info">{{$customer->status}}</div></td>
                          <td>
                            @if($customer->status=="Active")
                            <a href="{{URL::to('our_customers/Block', $customer->id)}}" class='btn btn-danger btn-sm'>Block</a>
                            @else
                            <a href="{{URL::to('our_customers/Active', $customer->id)}}" class='btn btn-warning btn-sm'>Unblock</a>
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

