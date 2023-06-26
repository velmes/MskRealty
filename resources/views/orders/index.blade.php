@php use App\Models\User; @endphp
@extends('home')

@section('main')
    <div class="p-5 rounded">
        @auth()
            <div class="row">
                <div class="col-sm-12">

                    <div class="display-6">Департамент Вторичной Недвижимости</div>
                    <div class="display-8 mt-3">Кросс-платформа для передачи, регистрации и дальнейшего отслеживания
                        заявок в Рекламный отдел Департамента Вторичной Недвижимости.

                        <p>Здесь вы можете создавать заявки и просматривать их историю и статусы, видеть комментарии
                            ответственного специалиста, прикрепленного к вашей заявке.</p>

                        <p class="center">Руководители подразделений могут просматривать заявки всех сотрудников своего
                            отдела.</p></div>
                    @if (Auth::user() && Auth::user()->role_id == '1')
                        <h1 class="display-6 mt-10">Ответсвенный по заявкам: {{auth()->user()->name}}</h1>
                    @else
                        <h1 class="display-6 mt-10">Все заявки</h1>
                    @endif


                    @if (Auth::user() && Auth::user()->role_id != '2')
                        <div>
                            <a style="margin: 19px;" href="{{ route('orders.create')}}" class="btn btn-primary">Создать
                                заявку</a>
                        </div>
                    @endif
                    <div class="table-responsive">

                        <table class="table align-middle">
                            <thead>
                            <tr class="bg-light">
                                @if (Auth::user() && Auth::user()->role_id == '1')
                                    <td>№</td>
                                    <td>Имя Клиента</td>
                                    <td>Телефон Клиента</td>
                                    <td>Ответсвенный, номер отдела, телефон</td>
                                    <td>Статус</td>
                                    <td>Комментарий из CRM</td>
                                    <td>Дата создания</td>
                                    <td>Дата редактирования</td>
                                    <td></td>
                                @else
                                    <td>№</td>
                                    <td>Имя Клиента</td>
                                    <td>Создатель заявки</td>
                                    <td>Ответсвенный, номер отдела, телефон</td>
                                    <td>Статус</td>
                                    <td>Дата создания</td>
                                    <td>Дата редактирования</td>
                                @endif
{{--                                <td>№</td>--}}
{{--                                <td>Имя Клиента</td>--}}
{{--                                <td>Телефон Клиента</td>--}}
{{--                                <td>Вопрос/задача(к решению)</td>--}}
{{--                                <td>Создатель заявки</td>--}}
{{--                                <td></td>--}}
{{--                                <td>Ответсвенный, номер отдела</td>--}}
{{--                                <td>Телефон ответсвенного</td>--}}
{{--                                <td>Статус</td>--}}
{{--                                <td>Комментарий из CRM</td>--}}
{{--                                <td>дата созд</td>--}}
{{--                                <td>дата ред</td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($orders as $order)
                                <tr>

                                    @if (Auth::user() && Auth::user()->role_id == '1')
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->client}}</td>
                                        <td>{{$order->call}}</td>
                                        <td>{{$order->responsible}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->answer}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->updated_at}}</td>
                                    @else
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->client}}</td>
                                        <td>{{User::where('id', $order->user_id)->get()->first()->name}}</td>
                                        <td>{{User::where('id', $order->user_id)->get()->first()->surname}}</td>
                                        <td>{{$order->responsible}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->updated_at}}</td>
                                    @endif
                                        {{--                                    <td>{{$order->id}}</td>--}}
{{--                                    <td>{{$order->client}}</td>--}}
{{--                                    <td>{{$order->call}}</td>--}}
{{--                                    <td>{{$order->comment}}</td>--}}
{{--                                    <td>{{User::where('id', $order->user_id)->get()->first()->name}}</td>--}}
{{--                                    <td>{{User::where('id', $order->user_id)->get()->first()->surname}}</td>--}}
{{--                                    <td>{{$order->responsible}}</td>--}}
{{--                                    <td>{{$order->number}}</td>--}}
{{--                                    <td>{{$order->status}}</td>--}}
{{--                                    <td>{{$order->answer}}</td>--}}
{{--                                    <td>{{$order->created_at}}</td>--}}
{{--                                    <td>{{$order->updated_at}}</td>--}}



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
{{--                                    <td>--}}
{{--                                            <form action="{{ route('orders.show', $order->id)}}" method="get">--}}
{{--                                                @csrf--}}
{{--                                                <button class="btn btn-danger" type="submit">Полная инфа</button>--}}
{{--                                            </form>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
