@extends('home')

@section('main')
    <div class="p-5 rounded">
        @auth
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="display-3">Ваши заявки</h1>
                    <div>
                        <a style="margin: 19px;" href="{{ route('orders.create')}}" class="btn btn-primary">Создать заявку</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>№</td>
                            <td>Имя Клиента</td>
                            <td>Телефон Клиента</td>
                            <td>Вопрос/задача(к решению)</td>
                            <td>Ответсвенный</td>
                            <td>Статус</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->client}}</td>
                                <td>{{$order->call}}</td>
                                <td>{{$order->comment}}</td>
                                <td>{{$order->responsible}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{ route('orders.edit',$order->id)}}" class="btn btn-primary">Редактировать</a>
                                </td>
                                <td>
                                    <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>
                    <div class="col-sm-12">

                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
        @endauth

        @guest
            <p class="lead">Пожалуйста, войдите в систему, чтобы просмотреть заявки.</p>
        @endguest
    </div>

@endsection
