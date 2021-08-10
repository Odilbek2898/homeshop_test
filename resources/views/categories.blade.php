@extends('layouts.master')
<?php use App\Models\Category;
$categories = Category::paginate(6);?>
@section('title', 'Все категории')

@section('content')
<div class="col-sm-12 col-md-12">
    <br>
    <br>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-sm-6 col-md-4">
            <div class="caption">
                <a href="{{ route('category', $category->code) }}">
                    <img src="{{ Storage::url($category->image) }}" height="240px" width="240px">
                    <h2>{{ $category->name }}</h2>
                </a>
                <p>{{ $category->description }}</p>
            </div><br>
        </div>
        @endforeach
    </div>
    {{$categories->links('pagination::bootstrap-4')}}
</div>
@endsection
