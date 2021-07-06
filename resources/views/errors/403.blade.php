@extends('platform::dashboard')

@section('title', '403')
@section('description', "У вас нет доступа к этому разделу")

@section('content')

    <div class="container p-md-5 layout">
        <div class="display-1 text-muted mb-5 mt-sm-5 mt-0">
            <x-orchid-icon path="shield"/>
            403
        </div>
        <h1 class="h2 mb-3">Нет доступа</h1>
        <p class="h4 text-muted font-weight-normal mb-7">Вы запросили страницу, к которой у вас нет доступа</p>
    </div>

@endsection
