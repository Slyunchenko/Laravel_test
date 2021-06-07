@extends('layout')
@section('title')Создание категории@endsection

@section('main_content')
    @if ($errors->any())
        <div class ="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row ml-3">
        <div class="col-4"></div>
        <div class="col-4">

            <form class="m-3" method="POST" action="/create/check">
                @csrf

                <div class="form-group">
                    <input class="form-control" type="text" name="category_name" placeholder="Название">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" type="text" name="category_description" placeholder="Описание"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
@endsection
