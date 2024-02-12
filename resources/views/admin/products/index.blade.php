@extends('layouts.app')

@section('title', "Categoria")


@section('content_header')
<h1>
    Produtos
    <li><a href="{{ route('products.create') }}" class="btn btn-sucess">adcionar produto</a></li>
</h1>

<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}">Dashboard</a></li>
    <li><a href="{{ route('products.create') }}" class="active">Produtos</a></li>
</ol>


@stop
@section('content') 
   <div class="content row">

    <div class="box box-success">
        <div class="box-body">
            <form action="{{ route('products.search') }}" method="post" class="form form-inline">
                @csrf
                <select name="category" class="form-control">
                    <option value="">Categoria</option>
                    @foreach ($categories as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>                
                <input type='text' name="name" placeholder="Nome:" class="form-control">

                <input type='text' name="price" placeholder="Preço:" class="form-control">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>        
    </div>

    <div class="box box-success">
    <div class="box-body">
        
        @include('admin.includes.alerts')

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">url</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    <th width='100px'scope="col">ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->name }}</th>
                    <th scope="row">{{ $product->url }}</th>
                    <td>{{ $product->category->title}}</td>
                    <td>{{ $product->price }}</td>
        
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">Detalhes</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar Produto</a>

        {{ $products->links() }}
    </div>
</div>
</div>
@stop