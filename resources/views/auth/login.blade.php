@extends('layouts.auth')
@section('title', 'Login')
@section('content')

    <div class="login">
        <div class="row">
            <div class="col-md-4">
                <div class="head">
                    <h1 style="color:white;">Geek Bot</h1>
                    <h2 style="color:white;">Login</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-style">
                    <center>
                        <h1 style="color:white">Log In</h1>
                        <img src="/images/Login.png" class="img-fluid">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <p style="color:white">Email</p>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                autocomplete="nama" autofocus required><br><br>

                            <p style="color:white">Password</p>
                            <input type="password" name="password" id="password" required><br>
                            <button type="submit" class="btn-submit">Log In</button>
                        </form>
                    </center>
                </div>
            </div>
            @if (session()->has('errors'))
                <div class="col-md-4">
                    <div class="alert alert-dismissible" role="alert">
                        <div class="form-style">
                            <center>

                                <h4 class="text-danger">{{ session('errors') }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </center>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
