@extends('layouts.app')

@section('title', 'Criar Produto')

@section('content_header')
    <h1>criar produto</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}">Produtos</a></li>
        <li><a href="{{ route('products.create') }}" class="active">criar produto</a></li>
    </ol>
@stop

@section('content')
<div class="content row">
    <div class="box box-success">
        <div class="box-body">
                @include('admin.includes.alerts')
                {{ Form::open(['route' => 'products.store', 'class' => 'form']) }}
                @include('admin.products._partials.form')
    
        </div>
    </div>
</div>
@stop
