@extends('layouts.layout')

@section('title')
Cart
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
                    <input class="form-control me-2" autocomplete="off" type="search" @if(isset($keyword)) value="{{$keyword}}" @endif name="keyword" placeholder="Search" aria-label="Search">
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

@if(Cart::total() > 0)
<div class="row forHeader">
    <div class="col-md-8">
        <div class="cartData">
            <h5>cart ({{Cart::content()->count()}})</h5>
            <hr>
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">product</th>
                        <th scope="col">Qty</th>
                        <th scope="col">price</th>
                        <th scope="col">remove</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($cart as $H)
                    <tr>
                        <td>{{$H->name}}</td>
                        <td>{{$H->qty}}</td>
                        <td>${{$H->price}}</td>
                        <td><a href="{{url('/remove/'.$H->rowId)}}">remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <h5>Cart Summary</h5>
        <hr>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">priceTotal</th>
                    <th scope="col">{{Cart::priceTotal()}}</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{url('/checkout/'.Cart::priceTotal())}}" class="btnOrange btn btn-info">checkOut</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@else
<div class="row forHeader">
    <div class="col-md-12">
        <div class=" w-50 text-center m-auto">
            <ion-icon class="iconNotFound" name="cart-outline"></ion-icon>
            <h4>Your cart is empty!</h4>
            <p>Browse our categories and discover our best deals!</p>
    
            <a href="{{url('/index')}}" class="btnOrangee btn btn-info">Start Shopping</a>
        </div>
    </div>
</div>
@endif


@endsection