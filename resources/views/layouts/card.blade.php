<div class="col-sm-6 col-md-4"  style="width:390px;height:460px;">
    <div class="thumbnail" style="width:360px;height:440px;">
        <div class="labels">
            @if($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif

            @if($product->isHit())
                <span class="badge badge-danger">Хит продаж!</span>
            @endif

            @if($product->isRecommend())
                <span class="badge badge-warning">Рекомендуем</span>
            @endif
        </div>
        <img src="{{ Storage::url($product->image) }}" height="250px">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} sum</p>
            <p>
            <form action="{{ route('basket-add', $product) }}" method="POST">
                @if($product->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                    Не доступен
                @endif
                <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}" class="btn btn-default"
                   role="button">Подробнее</a>
                @csrf
            </form>
            </p>
        </div>
    </div>
</div>
