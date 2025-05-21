@extends("welcome")
@section("title","Login/Register page")
@section("content")
<style>
    /* Định dạng chung */
    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], input[type="password"], input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    /* Giới tính */
    .gender-group {
        display: flex;
        gap: 15px;
        font-size: 16px;
    }

    .gender-group label {
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Khi chọn giới tính, highlight */
    input[type="radio"] {
      appearance: none; /* Ẩn kiểu mặc định */
      width: 16px;
      height: 16px;
      border: 2px solid #ccc;
      border-radius: 50%;
      background-color: white;
      cursor: pointer;
      position: relative;
      transition: 0.3s;
    }
    input[type="radio"]:checked {
      border-color: var(--main-color);
      background-color: var(--main-color);
    }
    input[type="radio"]:checked + label {
        font-weight: bold;
        color: #ffffff;
        background-color: var(--main-color);
        padding: 8px 15px;
        border-radius: 20px;
    }

    /* Căn chỉnh nhóm thể thao */
    .sports-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* Ẩn checkbox mặc định */
    .sports-group input[type="checkbox"] {
        display: none;
    }

    /* Style cho label (làm ô chữ nhật) */
    .sports-group label {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 10px;
        border: 2px solid var(--main-color);
        cursor: pointer;
        transition: 0.3s;
        background-color: white;
        color: var(--main-color);
        font-weight: bold;
        text-align: center;
    }

    /* Khi chọn, đổi màu toàn bộ label */
    .sports-group input[type="checkbox"]:checked + label {
        background-color: var(--main-color);
        color: white;
        border-color: var(--main-color);
    }

    /* Nút đăng ký */
    button {
        background-color: #007bff;
        color: white;
        padding: 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
        transition: 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<div class="container" style="margin-top:80px;">
    <!--form-->
    <section id="form">
      <h3 class="text-center p-2 mt-2 bg-success text-white text-notification-login">Hãy đăng nhập hoặc đăng kí một tài khoản để có thể mua hàng</h3>
      <div class="container-fluid my-2 login-form">
        <div class="row p-0 m-0" style="display:flex;justify-content:space-between">
          <div class="col-12 col-sm-5 col-sm-offset-1">
            <!--login form-->
            <div class="login-form">
              <h2 class="p-2 m-0 bg-success text-white">Đăng nhập</h2>						
              <form method="post" id="loginForm">
                @csrf
                <input class="form-control mt-1" type="email" name="email" placeholder="Email Address" required/>
                <input class="form-control mt-1" type="password" name="password" placeholder="Password" required/>
                <button  type="submit" class="mt-1">Login</button>							
              </form>
              <div id="loginMessage"></div>
            </div>
            <!--/login form-->
          </div>
          <div class="col-12 col-sm-1">
            <h2 class="or">Hoặc</h2>
          </div>
          <div class="col-12 col-sm-5">           
            <div class="signup-form">
              <h2 class="p-2 m-0 bg-success text-white">Đăng kí mới</h2>    
              <!--sign up form-->      
              <form action="{{ route('register_customer') }}" method="post">
                @csrf

                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="form-group">
                    <label>Retype Password:</label>
                    <input type="password" name="repassword" placeholder="Confirm password" required>
                </div>

                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" placeholder="Enter your phone number" required>
                </div>

                <div class="form-group">
                    <label>Age:</label>
                    <input type="number" name="age" min="1" max="100" placeholder="Enter your age" required>
                </div>

                <!-- Giới tính -->
                <div class="form-group">
                    <label>Gender:</label>
                    <div class="gender-group">
                        <label>
                            <input type="radio" name="gender" value="male" required>
                            <span>Male</span>
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" required>
                            <span>Female</span>
                        </label>
                        <label>
                            <input type="radio" name="gender" value="unisex" required>
                            <span>Other</span>
                        </label>
                    </div>
                </div>

                <!-- Môn thể thao yêu thích -->
                <div class="form-group">
                    <label>Favorite Sports:</label>
                    <div class="sports-group">
                      @foreach($category as $item)
                        <input type="checkbox" id="{{$item->slug}}"  name="preferences[]" value="{{$item->id}}">
                        <label for="{{$item->slug}}" >{{$item->name}}</label> 
                      @endforeach
                    </div>
                </div>

                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha mt-2" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback mt-1" style="display:block;">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
                @endif

                <button type="submit">Signup</button>
            </form>
            <!--/sign up form-->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--/form-->
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $('#loginForm').submit(function(e) {
        e.preventDefault(); // Ngăn load lại trang

        $.ajax({
        url: '{{ route("handle_login_customer") }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.status === 'success') {
                window.location.href = '{{ route("home") }}';
            } else {
            $('#loginMessage').html('<div class="text-danger">'+response.message+'</div>');
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessages = '';
            for (let key in errors) {
                errorMessages += '<div class="text-danger">'+errors[key][0]+'</div>';
            }
            $('#loginMessage').html(errorMessages);
        }
        });
    });
</script>
@stop