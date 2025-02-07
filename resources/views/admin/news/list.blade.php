@extends("admin.admin_layout")
@section("admin_page")
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách tin tức
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="trang-thai">Trạng thái</option>
          <option value="sort-a-to-z">Tên a->z</option>
        </select>
        <a href="" class="btn btn-sm btn-default">Chọn</a>                
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Hình ảnh</td>
            
            <th>Tiêu đề</th>        
            <th>Miêu tả</th>
            <th>Từ khóa</th>
            <th>Trạng thái</th>
            <th>Danh mục</th>
          </tr>
        </thead>
        <tbody>                     
                    @foreach($all_news as $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td><p class="text-ellipsis name"><img width="35%" src="{{url('/')}}/public/uploads/news/{{$item->image}}" alt="image news"></p></td>
                        
                        <td><p class="text-ellipsis name">{{$item->title}}</p></td>                    
                        <td><p class="text-ellipsis name">{!!$item->description!!}</p></td>                       
                        <td><p class="text-ellipsis name">{{$item->meta_keyword}}</p></td>                                                                      
                        <td><span class="text-ellipsis desc">
                                @if($item->status=='1')<a title="click to edit" href="{{route('edit_status_news',$item->id)}}"><i class="far fa-thumbs-up"></i></a>
                                @else <a title="click to edit" href="{{route('edit_status_news',$item->id)}}"><i class="far fa-thumbs-down"></i></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            <p class="text-ellipsis name">
                                <?php
                                    foreach ($all_category_news as $key => $value) {
                                        if($item->category_news_id==$value->id)echo $value->name;
                                    }                                   
                                ?>
                            </p>
                        </td>
                        <td>
                        <a title="click to edit" href="{{route('edit_news',$item->id)}}" ><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_news',$item->id)}}"><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach           
        </tbody>
      </table>
    </div> 
  </div>
</div>
@stop