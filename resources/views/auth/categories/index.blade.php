@extends('auth.layouts.master')

@section('title', 'Категории')

@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Подкатегория
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>@if($category->category_id)
                            {{$category->parent->name}}
                        @else
                            Нет родительской категории
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('categories.show', $category->id) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$categories->links('pagination::bootstrap-4')}}
        <a class="btn btn-success" type="button"
           href="{{ route('categories.create') }}">Добавить категорию</a>
    </div>
@endsection
