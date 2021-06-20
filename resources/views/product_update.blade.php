@extends('layout')

@section('title')Редактирование продукта@endsection

@section('main_content')
    @if($errors->any())
        <div class="alert alert-danger">
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

            <form class="m-3" method="POST" action="/edit-product/<?= $model['product_id']?>">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="product_name" placeholder="Название" value="<?= $model['product_name'];?>">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" type="text" name="product_description"
                              placeholder="Описание"><?= $model['product_description'];?></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" rows="5" type="text" name="product_price" placeholder="Цена" value="<?= $model['product_price'];?>">
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select id="category" name="category_id" class="form-control">
                            @foreach($categories as $item)
                                <option value="{{$item->getAttribute('category_id')}}">{{$item->getAttribute('category_name')}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
@endsection
