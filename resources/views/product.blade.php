@extends('layouts.master')

@section('title', 'Товар')

@section('content')
<section class="ttm-row about-section clearfix">
    <div class="container">
         <div class="row">
             <div class="col-lg-6 col-md-12">
                 <div class="ttm_single_image-wrapper text-left">
                 <br>
                     <img class="img-fluid" src="{{ Storage::url($product->image) }}" height="450px" width="500px" alt="{{ $product->name }}" />

                 </div>
             </div>
             <div class="col-lg-6 col-md-12 col-xs-12">
                 <div class="padding_top20 res-991-padding_top40">
                     <div class="section-title">
                         <div class="title-header">
                             <h3>{{ $product->category->name }}</h3>
                             <h2 class="title">{{ $product->name }}</b></h2>
                         </div>
                     </div>
                     <div class="ttm-highlight-quote margin_top35 clearfix">
                         <blockquote class=" ttm-bgcolor-grey"><p>{{ $product->description }}</p></blockquote>
                         <div class="d-flex align-items-center">
                             <div class="d-inline-block padding_left30">
                                 <h3 class="fs-20 mb-0">Цена: </h3>
                                 <label><h3>{{ $product->price }} sum</h3></label>
                             </div>
                         </div>
                         <form action="{{ route('basket-add', $product) }}" method="POST">
                            @if($product->isAvailable())
                                <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
                            @else
                                Не доступен
                            @endif
                            @csrf
                        </form>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</section>
@endsection
