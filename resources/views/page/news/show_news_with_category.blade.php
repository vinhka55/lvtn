@extends("welcome")
@section("content")
    @foreach($news as $item)
        <div class="card" style="width: 18rem;margin-top:50px;">
            <a href="{{route('detail_news',$item->slug)}}" class="btn btn-primary">
                <img src="{{url('/')}}/public/uploads/news/{{$item->image}}" class="card-img-top" alt="image news">
                <div class="card-body">
                <h5 class="card-title">{{$item->title}}</h5>
                <p class="card-text">{!!$item->description!!}</p>
            </a>
        </div>
        </div>
    @endforeach
@stop 