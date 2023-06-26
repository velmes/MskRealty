@extends('home')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Полная информация по вашей заявке</h1>
            <form method="get" action="{{ route('orders.index', $order->id) }}">
                @method('PATCH')
                @csrf
                <div class="table-responsive">

                    <table class="table align-middle">
                        <thead>
                        <tr class="bg-light">
                            <td>№</td>
                            <td>Имя Клиента</td>
                            <td>Телефон Клиента</td>
                            <td>Вопрос/задача(к решению)</td>
                            <td>Создатель заявки</td>
                            <td></td>
                            <td>Ответсвенный, номер отдела</td>
                            <td>Телефон ответсвенного</td>
                            <td>Статус</td>
                            <td>Комментарий из CRM</td>
                            <td>дата созд</td>
                            <td>дата ред</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->client}}</td>
                                <td>{{$order->call}}</td>
                                <td>{{$order->comment}}</td>
                                <td>{{User::where('id', $order->user_id)->get()->first()->name}}</td>
                                <td>{{User::where('id', $order->user_id)->get()->first()->surname}}</td>
                                <td>{{$order->responsible}}</td>
                                <td>{{$order->number}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->answer}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->updated_at}}</td>
                                </td>


                                @if (Auth::user() && Auth::user()->role_id != '2')
                                    <td>
                                        <a href="{{ route('orders.edit',$order->id)}}" class="btn btn-primary">Редактировать</a>
                                    </td>
                                @endif
                                <td>
                                    @if (Auth::user() && Auth::user()->role_id == '3')
                                        <form action="{{ route('orders.destroy', $order->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Удалить</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
