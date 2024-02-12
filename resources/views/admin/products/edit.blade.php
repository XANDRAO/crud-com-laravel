@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto {{ $product->title }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="active">Editar Produto</li>
    </ol>
@stop

@section('content')
<div class="content row">
    <div class="box box-success">
        <div class="box-body">

            @include('admin.includes.alerts')

            {{ Form::model($product, ['route' => ['products.update', $product->id], 'class' => 'form'])}}
                @method('PUT')
                @include('admin.products._partials.form')
                {{ Form::close() }}

            </form>
        </div>        
    </div>
</div>
@stop
