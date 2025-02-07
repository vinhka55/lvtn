@extends("welcome")
@section("content")
    @foreach($news as $item)
        <div class="container" style="margin-top:100px;">
            <img class="w-100 h-50" src="http://localhost/lvtn2022/public/uploads/news/{!!$item->image!!}" />
            <h1 class="p-2 bg-success text-white">{!!$item->title!!}</h1>
            <p>{!!$item->content!!}</p>
        </div>
    @endforeach
@stop 