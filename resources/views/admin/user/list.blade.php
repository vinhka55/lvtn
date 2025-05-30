@extends("admin.admin_layout")
@section("admin_page")
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Chọn loại tài khoản</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Lọc</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-center text-danger">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>        
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            
            <th>Admin</th>
            <th>Author</th>           
            <th>User</th>           
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($admin as $key => $user)
                <form action="{{route('assign_roles')}}" method="POST">
                    @csrf
                    <tr>          
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                        <td>{{ $user->phone }}</td>
                        
                        <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                        <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>      
                        <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>
                    <td>                              
                        <input type="submit" value="Phân quyền" class="btn btn-sm btn-info">  
                        <p style="margin:5px;"><a href="" data-id_login="{{Auth::id()}}" data-id_remove="{{$user->id}}" class="btn btn-danger delete-user">Xóa User</a></p> 
                        
                    </td> 
                    </tr>
                </form>
            @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">     
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection