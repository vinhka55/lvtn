<style>
    /* slide  */
    .slide{
        text-align: center;
        position: relative;
        height: 480px;
    }
    .one-slide{
        position: absolute;
        height: 100%;
        width: 100%;
        background-size: cover;
        animation: fadeIn linear 1s;
        display: none;
    }
    @keyframes fadeIn {
        from{
            opacity: 0;
        }
        to{
            opacity: 1;
        }
    }
    .one-slide--active{
        display: block;
    }

    .slide__list{
        display: inline;
        position: absolute;
        bottom: 0;
    }
    .slide__item{
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 5px;
        cursor: pointer;
        text-indent: -99999px;
        border: 1px solid white;
        transition: 0.4s;
    }
    .slide__item:hover{
        background-color: white;
    }

    .slide__item--active{
        background-color: white;
    }
</style>
<div class="container-fluid my-1">
    <!-- <div class="slider-top mt-3">
        <img width="100%" src="https://thucphamhuunghi.com/plugins/hinh-anh/banner/horizontal-404x-768-768-q1.webp" alt="top banner">
    </div> -->
    <div class="slide">
        <div class="one-slide one-slide--active" style="background-image: url('{{url('/')}}/public/assets/img/slide/index_slider_img_1.png');">
        </div>
        <div class="one-slide" style="background-image: url('{{url('/')}}/public/assets/img/slide/index_slider_img_2.webp');">
        </div>
        <div class="one-slide" style="background-image: url('{{url('/')}}/public/assets/img/slide/index_slider_img_4.webp');">
        </div>
        <ul class="slide__list">
            <li class="slide__item slide__item--active">1</li>
            <li class="slide__item">2</li>
            <li class="slide__item">3</li>
        </ul>
    </div>
    <div class="mt-3">
        @include("components.category-list")
    </div>
{{--    <div class="top-content row mx-0 px-0">--}}
        <!-- <div class="col-12 col-md-6">
            <img class="img-fluid" src="{{url('/')}}/public/frontend/images/main-2022-1280-400-qbanner.jpg" width="100%" alt="">
        </div> -->
        <!-- mpape -->
        <!-- <div class="col-12 col-md-3">
            <a href=""><img src="{{url('/')}}/public/assets/img/top-page/giphy.webp" class="img-fluid" width="100%" alt="gif image"></a>
        </div> -->
{{--    </div>--}}
</div>
<script>
    document.addEventListener("DOMContentLoaded",function(){
        var btnSlide=document.getElementsByClassName('slide__item')
        var slides=document.getElementsByClassName('one-slide')
        //nút bấm chuyển slide
        for (var index = 0; index < btnSlide.length; index++) {
            btnSlide[index].onclick=function(){
                for (var i = 0; i < btnSlide.length; i++) {
                    btnSlide[i].classList.remove('slide__item--active')
                }
                this.classList.add('slide__item--active')

                var btnActive=this
                var indexBtnActive=0
                for ( indexBtnActive = 0; btnActive = btnActive.previousElementSibling; indexBtnActive++) {
                }
                for (let index = 0; index < slides.length; index++) {
                    slides[index].classList.remove('one-slide--active')
                }
                slides[indexBtnActive].classList.add('one-slide--active')
            }
        }
        //xong nút bấm chuyển slide

        //auto chuyển slide
        autoSdile()
        function autoSdile(){
            setInterval(() => {
                var currentSlide=document.querySelector('.one-slide--active')
                var indexSlideActive=0
                for ( indexSlideActive = 0; currentSlide = currentSlide.previousElementSibling; indexSlideActive++) {
                }

                // console.log(indexSlideActive);
                for (let index = 0; index < slides.length; index++) {
                    slides[index].classList.remove('one-slide--active')
                    btnSlide[index].classList.remove('slide__item--active')
                }
                if(indexSlideActive==slides.length-1){
                    slides[0].classList.add('one-slide--active')
                    btnSlide[0].classList.add('slide__item--active')
                    // indexSlideActive=0
                }else{
                    slides[indexSlideActive].nextElementSibling.classList.add('one-slide--active')
                    btnSlide[indexSlideActive].nextElementSibling.classList.add('slide__item--active')
                }

            }, 5000);
        }
    })
</script>
