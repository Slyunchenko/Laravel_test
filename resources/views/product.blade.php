@extends('layout')

@section('title')Страница с товарами@endsection

@section('main_content')
    <a class="m-3 btn btn-danger" href="create-product">Создать продукт</a>
    <div class="col-6 border border-primary p-3">
        <form metod="GET" action="">
            @csrf
            <h1 align="center">Фильтр</h1>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="search">Поиск</label>
                        <input name="search" type="text" class="form-control" id="search"
                               placeholder="Поиск по Названию и Описанию">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="minSum">Сумма от</label>
                        <input name="minSum" type="text" class="form-control" id="minSum"
                               placeholder="Введите минимальную сумму">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="maxSum">Сумма до</label>
                        <input name="maxSum" type="text" class="form-control" id="maxSum"
                               placeholder="Введите максимальную сумму"><br/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select id="category" name="category" class="form-control">
                            @foreach($categories as $item)
                                <option
                                    value="{{$item->getAttribute('category_id')}}">{{$item->getAttribute('category_name')}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <input class="btn btn-success" type="submit" name="go" value="Применить"/></br>
        </form>
    </div>

    <div class="row">
        <div class="col-12">
            @grid(
            [
                'dataProvider' => $product,
                'showFilters' => false,
                'rowsPerPage' => 10,
                'columnOptions' => [
                    'class' => 'attribute',
                    'formatters' => 'text',
                ],
                'columns' => [
                    [
                        'title' => 'Название',
                        'value' => 'product_name',
                        'formatters' => ['text'],
                    ],
                    [
                        'title' => 'Описание',
                        'value' => 'product_description',
                        'formatters' => ['text'],
                    ],
                    [
                        'title' => 'Цена',
                        'value' => 'product_price',
                        'formatters' => ['text'],
                    ],
                    [
                        'title' => 'Категория',
                        'value' => 'category.category_name',
                        'formatters' => ['text'],
                    ],
                    [
                        'title' => 'Дата',
                        'value' => 'created_at',
                        'formatters' => ['text'],
                    ],
                    [
                        'class' => 'actions',
                        'formatters' => ['raw'],
                        'value' => [
                            'edit:/edit-product/{product_id}', // {id} - will be replaced with an attribute from row
                            'delete:/delete-product/{product_id}',
                        ]

                    ]
                ],
            ]
            )
        </div>
    </div>
@endsection
