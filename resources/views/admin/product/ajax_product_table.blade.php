@foreach($product as $item)
    <tr>
        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
        <td><p class="text-ellipsis name"><img width="35%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="product"></p></td>
        <td><a href="{{route('add_gallery',$item->id)}}">Thêm ảnh</a></td>
        <td><p class="text-ellipsis name">{{$item->name}}</p></td>
        <td><p class="text-ellipsis name">{{number_format((int)$item->price, 0, ',', '.')}}đ</p></td>                       
        <td>
            @php
                if($item->status == 1 ) echo '<div class="toggle-button on" onclick="toggleButton(this,'.$item->id.')"></div>';
                else echo '<div class="toggle-button" onclick="toggleButton(this,'.$item->id.')"></div>'; 
            @endphp
        </td>
        <td>
            @foreach($category as $cate)
                @if($cate->id==$item->category_id)
                {{$cate->name}}
                @endif
            @endforeach
        </td>
        <td><p class="text-ellipsis">{{$item->count}}</p></td>
        <td><p class="text-ellipsis">{{$item->count_sold}}</p></td>                       
        <td>
            <a title="click to edit" href="{{route('edit_product',$item->id)}}" ><i class="far fa-edit"></i></a>
            <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_product',$item->id)}}"><i class="fas fa-trash-alt text-danger text"></i></a>
        </td>
    </tr>
@endforeach

