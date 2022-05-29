@extends('layouts.app')
@section('page_style')

@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form bg-light mt-4 p-4">
                <form class="row g-3" method="POST" action="{{route('login.post')}}">
                    @csrf
                    <h4>Welcome Back</h4>
                    <div class="col-12">
                        <label>Username</label>
                        <input type="email" required value="{{ Request::old('email') }}" name="email" class="form-control" placeholder="johndoe@example.com">
                    </div>
                    <div class="col-12">
                        <label>Password</label>
                        <input type="password" name="password" required minlength="8" value="{{ Request::old('password') }}" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark float-end">Login</button>
                    </div>
                </form>
                <hr class="mt-4">
                <div class="col-12">
                    <p class="text-center mb-0">Have not account yet? <a href="{{ route('register') }}">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection