@extends('layouts.app')

@section('title',  "Detalhes da Categoria {$category->title}")

@section('content_header')
<h1>{{ $category->title }}</h1>

<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}">Dashboard</a></li>
    <li><a href="{{ route('categories.index') }}">Categorias</a></li>
    <li><a href="{{ route('categories.show', $category->id) }}" class="active">Detalhes</a></li>
</ol>

@stop
@section('content') 
   <div class="content row">
    <div class="box box-success">
    <div class="box-body">
        <p><strong>ID:</strong>{{ $category->id }}</p>
        <p><strong>Titulo:</strong>{{ $category->title }}</p>
        <p><strong>URL:</strong>{{ $category->url }}</p>
        <p><strong>Descrição:</strong>{{ $category->description }}</p>

        <hr>
        <form action="{{ route('categories.destroy', $category->id) }}" class="form" method="POST">
            @csrf   
            <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger">deletar</button>
        </form>

    </div>
</div>
</div>
<a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="black">Edit</a>
<a href="{{ route('categories.create') }}" class="btn btn-success">add</a>
@stop