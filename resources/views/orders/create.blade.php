@extends('home')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Добавление новой заявки</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputClient">Имя Клиента:</label>
                        <input type="text" class="form-control  @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" id="inputClient">
                        @error('client')
                        <div id="inputClient" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputCall">Телефон Клиента:</label>
                        <input type="text" class="form-control  @error('call') is-invalid @enderror" name="call" value="{{ old('call') }}" id="inputCall">
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment">Вопрос/задача(к решению):</label>
                        <input type="text" class="form-control" name="comment"/>
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @if (Auth::user() && Auth::user()->role_id == '3')
                    <div class="mb-3">
                        <label for="responsible">Ответсвенный, номер отдела:</label>
                        <input type="text" class="form-control" name="responsible"/>
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="number">Телефон ответсвенного:</label>
                        <input type="text" class="form-control" name="number"/>
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="status">Статус:</label>
                        <input type="text" class="form-control" name="status"/>
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="answer">Комментарий из CRM:</label>
                        <input type="text" class="form-control" name="answer"/>
                        @error('call')
                        <div id="inputCall" class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @endif
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
