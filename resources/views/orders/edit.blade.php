@extends('home')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Редактирование заявки</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('orders.update', $order->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="client">Имя Клиента:</label>
                    <input type="text" class="form-control" name="client" value={{ $order->client }} />
                </div>

                <div class="form-group">
                    <label for="call">Телефон Клиента:</label>
                    <input type="text" class="form-control" name="call" value={{ $order->call }} />
                </div>

                <div class="form-group">
                    <label for="comment">Вопрос/задача(к решению):</label>
                    <input type="text" class="form-control" name="comment" value={{ $order->comment }} />
                </div>
                @if (Auth::user() && Auth::user()->role_id == '3')
                <div class="form-group">
                    <label for="responsible">Ответсвенный, номер отдела:</label>
                    <input type="text" class="form-control" name="responsible" value={{ $order->responsible }} />
                </div>
                <div class="form-group">
                    <label for="number">Телефон ответсвенного:</label>
                    <input type="text" class="form-control" name="number" value={{ $order->number }} />
                </div>
                <div class="form-group">
                    <label for="status">Статус:</label>
                    <input type="text" class="form-control" name="status" value={{ $order->status }} />
                </div>
                <div class="form-group">
                    <label for="answer">Комментарий из CRM:</label>
                    <input type="text" class="form-control" name="answer" value={{ $order->answer }} />
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>
@endsection
