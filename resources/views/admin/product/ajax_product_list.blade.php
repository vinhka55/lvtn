@foreach($products as $item)
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td><img width="35%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="product"></td>
        <td><a href="{{route('add_gallery',$item->id)}}">Thêm ảnh</a></td>
        <td>{{$item->name}}</td>
        <td>{{number_format((int)$item->price, 0, ',', '.')}}đ</td>
        <td>
            @php
                if($item->status == 1 ) echo '<div class="toggle-button on" onclick="toggleButton(this,'.$item->id.')"></div>';
                else echo '<div class="toggle-button" onclick="toggleButton(this,'.$item->id.')"></div>'; 
            @endphp
        </td>
        <td>
            @php
                $cate = DB::table('category')->where('id', $item->category_id)->first();
                echo $cate ? $cate->name : '';
            @endphp
        </td>
        <td>{{$item->count}}</td>
        <td>{{$item->count_sold}}</td>
        <td>
            <a href="{{route('edit_product',$item->id)}}"><i class="far fa-edit"></i></a>
            <a onclick="return confirm('Are you sure?')" href="{{route('delete_product',$item->id)}}"><i class="fas fa-trash-alt text-danger text"></i></a>
        </td>
    </tr>
@endforeach
