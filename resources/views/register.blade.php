{{-- header part shows via component --}}
<x-header title="Register | Fashion E-commerce" description="register Page of fashion ecommerce" keywords='register ecommerce multirole client'/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="section-title">
                <h2>Create a New Account Here</h2>
                <span>Register Now!!!</span>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        <form action="{{URL::to('registerUser')}}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name='fullname' placeholder="Full Name" require>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name='email' placeholder="E-mail" require>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" class='form-control' name='file' require>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name='password' placeholder='Password' require>
                                    <button type="submit" name='register' class="site-btn">Register</button>
                                </div>
                            </div>
                            <p>Already have an account? Click here for <a href="{{URL::to('/signin')}}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
{{-- footer part shows via component --}}
<x-footer />
