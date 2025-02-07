@extends("welcome")
@section("title","Login page")
@section("content")

<div class="container" style="margin-top:80px;">
  <section id="form"><!--form-->
    <h3 class="text-center p-2 mt-2 bg-success text-white text-notification-login">Hãy đăng nhập hoặc đăng kí một tài khoản để có thể mua hàng</h3>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="container-fluid my-2 login-form">
        <div class="row p-0 m-0" style="display:flex;justify-content:space-between">
          <div class="col-12 col-sm-5 col-sm-offset-1">
            <div class="login-form"><!--login form-->
              <h2 class="p-2 m-0 bg-success text-white">Đăng nhập</h2>						
              <form action="{{route('handle_login_customer')}}" method="post">
                @csrf
                <input class="form-control mt-1" type="email" name="email" placeholder="Email Address" />
                              <input class="form-control mt-1" type="password" name="password" placeholder="Password" />
                <p>
                  <input type="checkbox" class="checkbox"> 
                  Keep me signed in
                </p>
                <button  type="submit" class="btn btn-primary">Login</button>							
                <p><a href="{{route('login_google')}}">Login with google account</a></p>
              </form>
            </div><!--/login form-->
          </div>
          <div class="col-12 col-sm-1">
            <h2 class="or">Hoặc</h2>
          </div>
          <div class="col-12 col-sm-5">
            <div class="signup-form"><!--sign up form-->
              <h2 class="p-2 m-0 bg-success text-white">Đăng kí mới</h2>
              
              <form action="{{route('register_customer')}}" method="post">
                  @csrf
                  <input class="form-control mt-1" type="text" name='name' placeholder="Name"/>
                  <input class="form-control mt-1" type="email" name='email' placeholder="Email Address"/>
                  <input class="form-control mt-1" type="password" name='password' placeholder="Password"/>
                  <input class="form-control mt-1" type="password" name='repassword' placeholder="Retype Password"/>
                  <input class="form-control mt-1" type="text" name='phone' placeholder="Phone"/>
                  <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                  <br/>
                  @if($errors->has('g-recaptcha-response'))
                  <span class="invalid-feedback mt-1" style="display:block;">
                      <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                  </span>
                  @endif
                  <button type="submit" class="btn btn-primary mt-1">Signup</button>
              </form>
            </div><!--/sign up form-->
          </div>
        </div>
      </div>
    </section><!--/form-->
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop