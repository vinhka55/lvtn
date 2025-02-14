<style>
        .marquee-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            background: #222;
            color: white;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
            position: relative;
        }
        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 10s linear infinite;
        }
        @keyframes marquee {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
        .marquee-text:hover {
            animation-play-state: paused;
        }
    </style>
    @foreach($coupon as $item)
        <div class="marquee-container">
            <span class="marquee-text">🔥 Khuyến mãi đặc biệt hôm nay! Nhập mã <span class="red">"{{$item->code}}"</span> : <span class="red">{{$item->name}}</span> 🔥</span>
        </div>
    @endforeach