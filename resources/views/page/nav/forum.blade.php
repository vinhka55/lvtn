<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        padding: 10px 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    .nav-logo {
        height: 40px;
    }
    .nav-right {
        display: flex;
        align-items: center;
        margin-right: 42px;
    }
    .user-menu {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 150px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .user-menu:hover .dropdown-menu {
        display: block;
    }
    .dropdown-menu li {
        list-style: none;
        padding: 8px;
    }
    .dropdown-menu li a, .dropdown-menu li button {
        text-decoration: none;
        color: #333;
        display: block;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
    }
    .dropdown-menu li button:hover,
    .dropdown-menu li a:hover {
        background: #f1f1f1;
    }
    .login-btn {
        background: #3498db;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
    }
</style>
<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('home') }}">
        @foreach($setting as $item)
            <img src="{{ url('/')}}/public/assets/img/logo/{{ $item->logo }}" alt="Logo" class="nav-logo">
        @endforeach
        </a>
    </div>
    <div class="nav-right">
        @if(Session::has('user_id'))
            <div class="user-menu">              
                <img src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="User Avatar" class="user-avatar">
                <span class="user-name">{{ Session::get('name_user') }}</span>
                <ul class="dropdown-menu">
                    <li><a href=" ">My posts</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="login-btn">Đăng nhập</a>
        @endif
    </div>
</nav>

