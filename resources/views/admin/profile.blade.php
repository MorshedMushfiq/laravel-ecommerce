<x-adminheader title="Account Informations"/>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-12 col-md-6 col-lg-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">My Profile</p>
                    <div class="contact__form">
                        <div class="msg">
                            @if(Session::has("success"))
                            <p class='alert alert-success'>{{Session::get('success')}}</p>
                            @endif
                            @if(Session::has("error"))
                            <p class='alert alert-danger'>{{Session::get('error')}}</p>
                            @endif
                        </div>
                        <img class='d-block' style='width: 200px; padding: 20px; margin: 0px auto;' src="{{URL::asset('uploads/profiles/' . $admin_user->image)}}" alt="">
                        <form action="{{route('user.update')}}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class='form-control mb-2' name='fullname' placeholder="Full Name" value="{{$admin_user->fullname}}" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name='email' placeholder="E-mail" class='form-control mb-2' value="{{$admin_user->email}}" readonly required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" class='form-control mb-2' name='file' required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" value="{{$admin_user->password}}" name='password' class='form-control mb-2' placeholder='Password' required>
                                    <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                </div>
                            </div>
                            {{-- <p>Already have an account? Click here for <a href="{{URL::to('/signin')}}">Sign in</a></p> --}}
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->


<x-adminfooter />

