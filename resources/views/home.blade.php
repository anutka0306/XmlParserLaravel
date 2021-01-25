@extends('layouts.main')

@section('title')
    @parent Главная
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <p>Чтобы загрузить новый список клиентов, загрузите файл clients.xml</p>
                        <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="file" required multiple name="xml" class="@error('xml') is-invalid @enderror">
                            <button type="submit">Загрузить</button>
                        </form>
                        @error('xml')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




