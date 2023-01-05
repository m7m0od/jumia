@extends('layouts.layout')

@section('title')
    ForgetPassword
@endsection

@section('content')

<div class="alignItem">
    <form method="POST" action="{{url('/forget-password')}}">
        @csrf
        <a href="{{url('/index')}}"><img class=" mb-3" src="{{asset('uploads/l.png')}}"></a>
        <p>Enter the email address associated with your account , please!</p>
        <div class="form-group forPosition">
            <input type="email" name="email" placeholder="type your email" class="form-control inputFocus">
            <ion-icon name="mail-outline"></ion-icon>
            @error('email')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
            <button type="submit" class="btnn btn">submit</button>
    </form>
    @if(Session::has('status'))
    <div class="mt-2">
        <p class="text-center m-auto alert alert-info">{{ Session('status') }}</p>
    </div>
    @endif
</div>

@endsection