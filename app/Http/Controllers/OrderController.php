<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()){
            return view('auth.login');
        }
        elseif (Auth::user()->role_id=='3'){
            $orders = Order::orderBy('id', 'desc')->get();
        }
        elseif (Auth::user()->role_id=='2'){
            $orders = Order::where('office_id', Auth::user()->office_id)
                ->orderByDesc('orders.office_id')
                ->orderBy('id', 'desc')
                ->get();
        }
        else {

            $orders = Order::leftJoin('users', 'users.id', '=', 'orders.user_id')
                ->orderByDesc('orders.id')
                ->get();
            $orders = Order::where('office_id', Auth::user()->office_id)->where('user_id', Auth::user()->id)
                ->orderByDesc('orders.office_id')
                ->orderByDesc('orders.id')
                ->get();

        }

        return view('orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client'=>'required',
            'call'=>'required',
            'comment'=>'required'
        ]);

        $order = new Order([
            'client' => $request->get('client'),
            'call' => $request->get('call'),
            'comment' => $request->get('comment'),
            'responsible' => $request->get('responsible'),
            'status' => $request->get('status'),
            'number' => $request->get('number'),
            'answer' => $request->get('answer'),
            'user_id' => Auth::user()->id,
            'office_id' => Auth::user()->office_id,
        ]);

        $order->save();

        return redirect('/orders')->with('success', 'Заявка создана!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (Auth::user()->role_id=='3'){
            $orders = Order::orderBy('id', 'desc')->get();
        }
        elseif (Auth::user()->role_id=='2'){
            $orders = Order::where('office_id', Auth::user()->office_id)
                ->orderByDesc('orders.office_id')
                ->orderBy('id', 'desc')
                ->get();
        }
        else {

            $orders = Order::leftJoin('users', 'users.id', '=', 'orders.user_id')
                ->orderByDesc('orders.id')
                ->get();
            $orders = Order::where('office_id', Auth::user()->office_id)->where('user_id', Auth::user()->id)
                ->orderByDesc('orders.office_id')
                ->orderByDesc('orders.id')
                ->get();

        }

        return view('orders.modal', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client'=>'required',
            'call'=>'required',
            'comment'=>'required'
        ]);

        $order = Order::find($id);
        $order->client =  $request->get('client');
        $order->call = $request->get('call');
        $order->comment = $request->get('comment');
        if(Auth::check())
        {
            if($request->user()->role_id=='3')
            {
                $order->responsible = $request->get('responsible');
                $order->status = $request->get('status');
                $order->number = $request->get('number');
                $order->answer = $request->get('answer');
            }
        }
        $order->save();

        return redirect('/orders')->with('success', 'Заявка обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('/orders')->with('success', 'Заявка удалена!');
    }
}
