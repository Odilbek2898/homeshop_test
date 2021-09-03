<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Home Shop: @yield('title')  </title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <link rel="shortcut icon" href="{{ Storage::url('logo.jpg') }}" type="image/x-icon">
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">

    <style>
        ul li ul {
          visibility: hidden;
          opacity: 0;
          position: absolute;
          transition: all 0.5s ease;
          margin-top: 1rem;
          left: 0;
          display: none;
        }

        ul li:hover > ul,
        ul li ul:hover {
          visibility: visible;
          opacity: 1;
          display: block;
        }

        ul li ul li {
          clear: both;
          width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container">
        <div class="navbar-header">
            {{--<a class="navbar-brand" href="{{ route('index') }}"><img src="{{ Storage::url('logo.jpg') }}" height="35px">Home Shop</a>--}}
            <a class="navbar-brand" href="{{ route('index') }}">Home Shop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')><a href="{{ route('index') }}">Все товары</a></li>

                <?php
                    use App\Models\Category;
                    $categories = Category::whereNull('category_id')->orderBy('name', 'DESC')->get();
                ?>

                <li @routeactive('categor*')><a href="{{ route('categories') }}">Категории</a>
                     <ul class="dropdown-menu">
                         @foreach($categories as $category)

                             @if ($category->children->count())
                                <li class="dropdown-submenu"><a class="dropdown-item submenu"  href="{{ route('category', $category->code) }}" data-toggle="collapse">{{ $category->name }}</a>
                                     <ul class="dropdown-menu">
                                        @foreach ($category->children as $child)
                                           <li><a href="{{ route('category', $child->code) }}">{{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown-submenu"><a href="{{ route('category', $category->code) }}" data-toggle="collapse">{{ $category->name }}</a></li>
                            @endif
                         @endforeach
                     </ul>
                </li>
                <li @routeactive('basket*')><a href="{{ route('basket') }}">В корзину</a></li>
                {{-- <li><a href="{{ route('index') }}">Сбросить проект в начальное состояние</a></li> --}}
                {{--                <li><a href="http://internet-shop.tmweb.ru/locale/en">en</a></li>--}}

                {{--                <li class="dropdown">--}}
                {{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>--}}
                {{--                    <ul class="dropdown-menu">--}}
                {{--                        <li><a href="http://internet-shop.tmweb.ru/currency/RUB">₽</a></li>--}}
                {{--                        <li><a href="http://internet-shop.tmweb.ru/currency/USD">$</a></li>--}}
                {{--                        <li><a href="http://internet-shop.tmweb.ru/currency/EUR">€</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest()
                    {{-- <li><a href="{{route('login')}}">Войти</a></li> --}}
                @endguest

                @auth
                    @admin
                        <li><a href="{{route('home')}}">Панел админа</a></li>
                    @else
                        <li><a href="{{route('person.orders.index')}}">Мои заказы</a></li>
                    @endadmin
                    <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <div class="container">
        <div class="starter-template">
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            @if(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>
