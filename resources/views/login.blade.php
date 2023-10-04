{{-- header part shows via component --}}
<x-header title="Login | Fashion E-commerce" description="login Page of fashion ecommerce" keywords='login ecommerce multirole client'/>

    <!-- login Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="section-title">
                <h2>Sign in For Your Dashboard</h2>
                <span>Sign in now!!!</span>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="msg">
                        @if(Session::has("success"))
                        <p class='alert alert-success'>{{Session::get('success')}}</p>
                        @endif
                        @if(Session::has("error"))
                        <p class='alert alert-danger'>{{Session::get('error')}}</p>
                        @endif
                    </div>
                    <div class="contact__form">
                        <form action="{{URL::to('/signinUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" name='email' placeholder="E-mail" require>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name='password' placeholder='Password' require>
                                    <button type="submit" name='signin' class="site-btn">Sign In</button>
                                    <a href="{{URL::to('google/login')}}">
                                        <img src="{{URL::asset('googlesignin.png')}}" style='height: 120px;' alt="">
                                    </a>
                                </div>

                            </div>
                            <p>Don't have any account? Click here for <a href="{{URL::to('/register')}}">Register</a></p>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- login Section End -->
{{-- footer part shows via component --}}
<x-footer />
