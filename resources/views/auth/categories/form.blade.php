@extends('auth.layouts.master')

@isset($category_id)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактировать Категорию <b>{{ $category->name }}</b></h1>
        @else
            <h1>Добавить Категорию</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($category)
              action="{{ route('categories.update', $category) }}"
              @else
              action="{{ route('categories.store') }}"
            @endisset
        >
            <div>
                @isset($category)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{ old('code', isset($category) ? $category->code : null) }}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($category){{ $category->name }}@endisset">
                    </div>
                </div>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Подкатегория: </label>
                    <div class="col-sm-6">
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <select name="category_id" class="form-control col-md-7 col-xs-12">
                            <option value="" @isset($category){{ $category->name }}@endisset>No Subcategory</option>
                            @foreach($categories as $category)
                                <option value="@isset($category){{ $category->id }}@endisset" @if($category->category_id!==null
                                && $category->category_id==$category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

{{--                <br>--}}
{{--                <div class="input-group row">--}}
{{--                    <label for="name" class="col-sm-2 col-form-label">Название en: </label>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        @error('name_en')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                        <input type="text" class="form-control" name="name_en" id="name_en"--}}
{{--                               value="@isset($category){{ $category->name_en }}@endisset">--}}
{{--                    </div>--}}
{{--                </div>--}}

                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea name="description" id="description" cols="72"
                                  rows="7" value="@isset($category){{ $category->description }}@endisset">@isset($category){{ $category->description }}@endisset</textarea>
                    </div>
                </div>
                <br>

{{--                <div class="input-group row">--}}
{{--                    <label for="description" class="col-sm-2 col-form-label">Описание en: </label>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        @error('description_en')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                        <textarea name="description_en" id="description_en" cols="72"--}}
{{--                                  rows="7">@isset($category){{ $category->description_en }}@endisset</textarea>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br>--}}

                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
