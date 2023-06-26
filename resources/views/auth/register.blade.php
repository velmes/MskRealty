@extends('home')

@section('main')
    <div class="container">
        <p class="main-title">Регистрация</p>
        <div class="row justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Введите имя</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" id="inputName">
                        @error('name')
                        <div id="inputName" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputSurname" class="form-label">Введите фамилию</label>
                        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                               value="{{ old('surname') }}" id="inputSurname">
                        @error('surname')
                        <div id="inputSurname" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputOffice" class="form-label">Департамент/отдел</label>
                        <select class="form-select @error('office_id') is-invalid @enderror" id="inputOffice" name="office_id" aria-label="Default select example">
                            <option value="1" selected>Апартаменты</option>
                            <option value="2">Рекламный отд.</option>
                        </select>
                        @error('office_id')
                        <div id="inputOffice" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Введите email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('phone') }}" id="inputEmail">
                        @error('email')
                        <div id="inputEmail" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Введите номер телефона</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" id="inputPhone">
                        @error('phone')
                        <div id="inputPhone" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Введите пароль</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               value="{{ old('password') }}" id="inputPassword">
                        @error('password')
                        <div id="inputPassword" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.phone').inputmask('+7(999)-999-9999');
        });
    </script>
@endsection
