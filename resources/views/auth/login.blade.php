@extends('home')

@section('main')
    <div class="container">
        <p class="main-title">Авторизация</p>
        <div class="row justify-content-center">
            <div class="col-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Введите email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" id="inputEmail">
                            @error('email')
                            <div id="inputEmail" class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Введите пароль</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   value="{{ old('password') }}" id="inputPassword">
                            @error('password')
                            <div id="inputPassword" class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
