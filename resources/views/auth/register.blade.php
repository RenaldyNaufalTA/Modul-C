@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <div class="login">
        <div class="row">
            <div class="col-md-4">
                <div class="head">
                    <h1 style="color:white;">Geek Bot</h1>
                    <h2 style="color:white;">Register</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-style">
                    <center>
                        <h1 style="color:white">Register</h1>
                        <img src="/images/Login.png" class="img-fluid">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <p style="color:white">Nama</p>
                            <input type="text" name="nama" id="nama" autofocus required
                                value="{{ old('nama') }}" autocomplete="email"><br><br>

                            <p style="color:white">Email</p>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email') }}"><br><br>

                            <p style="color:white">Password</p>
                            <input type="password" name="password" id="password" required><br><br>

                            <p style="color:white">No. HP</p>
                            <input type="text" name="noHP" id="noHP" required
                                value="{{ old('noHP') }}"><br><br>

                            <p style="color:white">Alamat Rumah</p>
                            <input type="text" name="alamat" id="alamat" required
                                value="{{ old('alamat') }}"><br><br>

                            <button type="submit" class="btn-submit">Register</button>
                        </form>
                    </center>
                </div>
            </div>
            @if (Session::has('errors'))
                <div class="col-md-4">
                    <div class="alert alert-dismissible" role="alert">
                        <div class="form-style">
                            <center>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-danger h4">{{ $error }}</li>
                                    @endforeach

                                </ul>
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
