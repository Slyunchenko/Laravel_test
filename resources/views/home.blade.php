@extends('layout')

@section('title')Главная страница@endsection

@section('main_content')
    <a class="m-3 btn btn-danger" href="create-category">Создать категорию</a>
    <div class="row ml-3">
        <div class="col-6 border border-primary p-3">
            <form method="GET" action="">
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
                                   placeholder="Введите максимальную сумму">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="minQty">Колличество от</label>
                            <input name="minQty" type="text" class="form-control" id="minQty"
                                   placeholder="Введите минимальное колличество">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="maxQty">Колличество до</label>
                            <input name="maxQty" type="text" class="form-control" id="maxQty"
                                   placeholder="Введите максимальное колличество">
                        </div>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" name="go" value="Применить"/><br/>
            </form>
        </div>
        <div class="col-6"></div>
    </div>
    <div class="row">
        <div class="col-12">

            @grid(
            [
                'dataProvider' => $provider,
                'showFilters' => false,
                'rowsPerPage' => 10,
                'columnOptions' => [
                    'class' => 'attribute',
                    'formatters' => 'text',
                ],
                'columns' => [
                    [
                        'title' => 'Название',
                        'value' => 'category_name',
                        'formatters' => ['text'],
                    ],
                    [
                        'title' => 'Описание',
                        'value' => 'category_description',
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
                            'edit:/edit-category/{category_id}', // {id} - will be replaced with an attribute from row
                            'delete:/delete-category/{category_id}',
                        ]
                    ]
                ],
            ]
            )
        </div>
    </div>

@endsection
