<style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; }
        .category-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1000px;
            margin: 20px auto;
        }
        .category {
            width: 18%;
            text-align: center;
            position: relative;
        }
        .category .image-container {
            position: relative;
            display: inline-block;
            border-radius: 50%;
        }
        .category img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #ddd;
            padding: 5px;
            transition: transform 0.5s ease-in-out;
            position: relative;
            z-index: -1;
        }
        .category:hover img {
            transform: rotate(360deg);
            border: 4px solid;
            border-color: #198754;
        }
        .image-container::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid #198754; 
            transform: translate(-50%, -50%) rotate(0deg);
            transition: transform 0.5s ease-in-out, opacity 0.3s, border-color 0.3s;
            opacity: 0;
            z-index: 1;
        }
        /* .category:hover img {
            border: 4px solid;
            border-color: #198754;
            transform: translate(-50%, -50%) rotate(360deg);
            opacity: 1;
        } */
        .category p {
            margin-top: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #198754;
        }
        
        /* Responsive styles */
        @media screen and (max-width: 1024px) {
            .category {
                width: 30%;
                margin-bottom: 15px;
            }
        }
        
        @media screen and (max-width: 768px) {
            .category {
                width: 45%;
                margin-bottom: 15px;
            }
        }
        
        @media screen and (max-width: 480px) {
            .category {
                width: 50%;
            }
        }
    </style>
<div class="category-list">
        @foreach($category as $cate)
        <div class="category">
            <a href="{{route('show_product_with_category',$cate->slug)}}">
                <img src="{{url('/')}}/public/assets/img/category/{{$cate->image}}" alt="{{$cate->name}}">
                <p>{{$cate->name}}</p>
            </a>
        </div>
        @endforeach
    </div>