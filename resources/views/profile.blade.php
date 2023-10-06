{{-- header part shows via component --}}
<x-header title="My Profile | Fashion E-commerce" description="my profile Page of fashion ecommerce" keywords='my profile ecommerce multirole client'/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="section-title">
                <h2>My account</h2>
                <span>{{$user->fullname}}({{$user->type}})</span>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        <div class="msg">
                            @if(Session::has("success"))
                            <p class='alert alert-success'>{{Session::get('success')}}</p>
                            @endif
                            @if(Session::has("error"))
                            <p class='alert alert-danger'>{{Session::get('error')}}</p>
                            @endif
                        </div>
                        <img class='d-block' style='width: 200px; padding: 20px; margin: 0px auto;' src="{{URL::asset('uploads/profiles/' . $user->image)}}" alt="">
                        <form action="{{route('user.update')}}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name='fullname' placeholder="Full Name" value="{{$user->fullname}}" require>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name='email' placeholder="E-mail" value="{{$user->email}}" readonly require>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" class='form-control' name='file' require>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" value="{{$user->password}}" name='password' placeholder='Password' require>
                                    <button type="submit" class="site-btn">Update</button>
                                </div>
                            </div>
                            {{-- <p>Already have an account? Click here for <a href="{{URL::to('/signin')}}">Sign in</a></p> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
{{-- footer part shows via component --}}
<x-footer />
