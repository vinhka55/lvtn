<div class="social-contact">
    <ul class="list-unstyled">
        <li class="facebookSF">
            <a href="https://m.me/www.247sport.vn" target="_blank" class="d-block mb-lg-2">
            <img src="{{url('/')}}/public/assets/img/social_contact/fb_message.png" alt="" width="45" height="45">        </a>
        </li>

        <li class="zaloSF">
            <a href="https://zalo.me/0981247888" title="0398855888" class="mb-lg-2" target="blank">
            <img src="{{url('/')}}/public/assets/img/social_contact/zalo.png" alt="" width="45" height="45">        </a>
        </li>
    </ul>
    <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
        @foreach($setting as $item)
            <p class="phone-social-hover">{{$item->phone}}</p>
        @endforeach
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle">
            <img src="{{url('/')}}/public/assets/img/social_contact/phone.png" alt="" width="45" height="45">      
        </div>
    </div>
</div>