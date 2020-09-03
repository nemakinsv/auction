

@extends('layouts.app')
@section('content')
    <div class="container">
        <a style="float: right;" href="{{ route('lot.add') }}">Добавить</a>
        <div class="row justify-content-center">

            <table class="table">
                <tr>
                    <th>Лот</th>
                    <th>Цена</th>

                </tr>
                @foreach($lots as $lot)
                    <tr>
                        <td><img src="{{env('APP_URL').str_replace("public", "storage", $lot->src)}}"
                                 height="200" alt="{{$lot->src}}"></td>
                        <td>{{$lot->start_price}}</td>
                        <td><a href="{{ route('auction.start', ['id' => $lot->id]) }}">Начать аукцион</a></td>
                        <td><a href="{{ route('lot.edit', ['id' => $lot->id]) }}">Изменить</a></td>
                        <td><a href="{{ route('lot.destroy', ['id' => $lot->id]) }}">Удалить</a></td>

                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection
