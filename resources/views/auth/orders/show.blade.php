@extends('auth.layouts.master')

@section('title', 'Заказ ' . $order->id)

@section('content')
    <div class="py-4">
        <div class="col-md-12">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Заказ №{{ $order->id }}</h1>
                    <p>Заказчик: <b>{{ $order->name }}</b></p>
                    <p>Телефон номер: <b>{{ $order->phone }}</b></p>
                    <p>Адрес Город: <b>{{ $order->address }}</b></p>
                    <p>Адрес Район: <b>{{ $order->address_rayon }}</b></p>
                    <p>Адрес Дом: <b>{{ $order->address_dom }}</b></p>
                    <p>Адрес Кв: <b>{{ $order->address_kv }}</b></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Название товара</th>
                                <th>Кол-во</th>
                                <th>Цена</th>
                                <th>Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                        <img height="56px" width="75px"
                                             src="{{ Storage::url($product->image) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td><span class="badge">{{ $product->pivot->count }}</span></td>
                                <td>{{ $product->price }} sum</td>
                                <td>{{ $product->getPriceForCount() }} sum</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Общая стоимость:</td>
                            <td>{{ $order->calculateFullSum() }} sum</td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
