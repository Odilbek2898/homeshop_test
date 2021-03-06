<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Classes\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();

        return view('basket', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        if((new Basket())->saveOrder($request->name, $request->phone, $request->address,
            $request->address_rayon, $request->address_dom, $request->address_kv)){
            session()->flash('success', 'Ваш заказ принят в обработку');
        }else{
            session()->flash('warning', 'Товар не доступен в полном объеме для заказа');

        }

        Order::eraseOrderSum();

        return redirect()->route('index');
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()){
            session()->flash('warning', 'Товар не доступен в полном объеме для заказа');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);

        if ($result) {
            session()->flash('success', 'Добавлен товар ' . $product->name);
        } else{
            session()->flash('warning', 'Товар ' . $product->name. ' в большем кол-ве не доступен для заказа');
        }
        return redirect()->route('basket');
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);
//        $order = $basket->getOrder();

        session()->flash('warning', 'Удален товар ' . $product->name);

        return redirect()->route('basket');
    }
}
