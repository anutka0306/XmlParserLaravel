@extends('layouts.main')

@section('title')
    @parent Клиенты
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <p>Здесь таблица</p>

                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>Клиент</th>
                                <th>ID</th>
                                <th>Возраст</th>
                                <th>Город</th>
                                <th>Дата</th>
                                <th>Телефоны</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                @php

                                @endphp
                            <tr>
                                <td>{{$client->name}}</td>
                                <td>{{$client->client_id}}</td>
                                <td>{{$client->age}}</td>
                                <td>{{$client->city_name}}</td>
                                <td>{{$client->membership_date}}</td>
                                <td>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{$client->phones}}">Показать телефоны</button>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="my-modal">
        hello
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Телефоны клиента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection






