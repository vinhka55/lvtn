@extends("welcome")
@section("title","Sport VN")
@section("content")
@include("components.coupon")
@include("page.header.header")

<div class="container-fluid p-3">  
    @foreach($data as $key => $sports)
        @php
            $categoryName = null;
            foreach ($category as $one) {
                if ($one->id === $sports[0]->category_id) {
                    $categoryName = $one->name;
                    break; // Stop looping once found
                }
            }
        @endphp
        @include("components.category-item-list", ['name_category' => $categoryName, 'product' => $sports, 'category' => $category])
    @endforeach
</div>
@endsection
