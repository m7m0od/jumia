@extends('layouts.layout')

@section('title')
Home
@endsection

@section('content')

<header id="Header">
    <nav class="navHeader navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container-fluid">

            <div class="first-content">
                <a class="navbar-brand" href="{{url('/index')}}">
                    <ion-icon class="forCarMargin headColor" name="cart-outline"></ion-icon> JUMIA
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="second-content collapse navbar-collapse" id="navbarSupportedContent">
                <form action="{{url('/search')}}" method="get" class="FORMWIDTH d-flex" role="search">
                    <input class="form-control me-2" required minlength="3" autocomplete="off" type="search" @if(isset($keyword)) value="{{$keyword}}" @endif name="keyword" placeholder="Search" aria-label="Search">
                    <button class="mr-4 ml-4 btn btn-jumia" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li><a href="#packages">SuperMarket</a></li>
                    <li><a href="#Offers">Offers</a></li>
                    <li class="active"><a href="#hotels">Help <i class="fa fa-question"></i></a></li>
                    <li><a href="{{url('/myCart')}}">
                            <ion-icon class="forCarMargin" name="cart-outline"></ion-icon> Cart ({{Cart::content()->count()}})
                        </a></li>
                    <li class="dropdown"><a href="javascript:void(0)" class="dropbtn">
                            <ion-icon class="forCarMargin" name="person-outline"></ion-icon> Account <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-content">
                            @guest
                            <a href="{{url('/signup')}}">
                                <ion-icon name="person-circle-outline"></ion-icon> SignUp
                            </a>
                            <a href="{{url('/login')}}">
                                <ion-icon name="log-in-outline"></ion-icon> Login
                            </a>
                            @endguest
                            @auth
                            <a href="{{url('/logout')}}">
                                <ion-icon name="log-out-outline"></ion-icon> LogOut
                            </a>
                            @endauth
                        </div>
                    </li>
                </ul>
                <div class="links">
                    <span class="icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="forHeader">
    @if(Session::has('success'))
    <div class="forHeader">
        <p class="w-50 text-center m-auto alert alert-info">{{ Session('success') }}</p>
    </div>
    @elseif(Session::has('error'))
    <div class="forHeader">
        <p class="w-50 text-center m-auto alert alert-info">{{ Session('error') }}</p>
    </div>
    @endif
    <div class="row mt-1">
        @if(isset($search))

        @foreach($search as $item)
        <div class="col-md-4">
            <div class="card forPositionCard">
                <img src="{{asset($item->pic)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{$item->title}}</h5>
                    </div>
                    <h6 class="card-text">{{$item->category->title}}</h6>
                    <h6 class="card-text">{{$item->description}}</h6>
                    <form action="{{url('/cart')}}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <input type="hidden" value="1" name="Q">
                        <button class="btnOrange btn btn-info">add to cart</button>
                    </form>
                </div>
                <div class="forPositionPrice">${{$item->price}}</div>
            </div>
        </div>
        @endforeach

        @else

        @foreach($items as $item)
        <div class="col-md-4">
            <div class="card forPositionCard">
                <img src="{{asset($item->pic)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{$item->title}}</h5>
                    </div>
                    <h6 class="card-text">{{$item->category->title}}</h6>
                    <h6 class="card-text">{{$item->description}}</h6>
                    <form action="{{url('/cart')}}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <input type="hidden" value="1" name="Q">
                        <button class="btnOrange btn btn-info">add to cart</button>
                    </form>
                </div>
                <div class="forPositionPrice">${{$item->price}}</div>
            </div>
        </div>
        @endforeach
        
        @endif
    </div>
</div>

@if(!isset($search))
<div class="forPagination d-flex justify-content-center">
    {!! $items -> links() !!}
</div>
@endif

@endsection