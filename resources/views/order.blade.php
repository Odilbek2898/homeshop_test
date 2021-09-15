@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>Подтвердите заказ:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Общая стоимость: <b>{{$order->calculateFullSum()}} sum.</b></p>
            <form action="{{ route('basket-confirm') }}" method="POST">
                <div>
                    <p>Укажите свои имя, номер телефона и адрес чтобы наш менеджер мог с вами связаться:</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control" required="">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер телефона: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control" required="">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-offset-3 col-lg-2">Адрес Город: </label>
                            <div class="col-lg-4">
                                <input type="text" name="address" id="address" value="" class="form-control" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-offset-3 col-lg-2">Адрес Район: </label>
                            <div class="col-lg-4">
                                <input type="text" name="address_rayon" id="address_rayon" value="" class="form-control" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-offset-3 col-lg-2">Адрес Дом: </label>
                            <div class="col-lg-4">
                                <input type="text" name="address_dom" id="address_dom" value="" class="form-control" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-offset-3 col-lg-2">Адрес Кв: </label>
                            <div class="col-lg-4">
                                <input type="text" name="address_kv" id="address_kv" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    @csrf
                    <br>
                    <input type="submit" class="btn btn-success" value="Подтвердите заказ">
                </div>
            </form>
        </div>
    </div>
@endsection
