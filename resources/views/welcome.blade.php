<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
              .img_wrap{

              }

            .img_wrap img{
                height:15rem;
                width:15rem;
                border-radius: 50%;
                border:2px solid #636b6f;
                padding:3px;
                transition: all 1s;
            }
            img:hover{
                transform: rotate(360deg);
                box-shadow: 0px 0px 3px 10px rgba(0,0,0,0.3);
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">登陆</a>
                    <a href="{{ url('/register') }}">注册</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md img_wrap">
                    <img src="http://o9dm67cfv.bkt.clouddn.com//md2016/1486965236677.png" alt="">
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">GITHUB</a>
                    <a href="https://laracasts.com">微博</a>
                    <a href="https://laravel-news.com">Blog</a>
                </div>
            </div>
        </div>
    </body>
</html>

