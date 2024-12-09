<!-- resources/views/products/create.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Show</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Show</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div id="app" class="content"> <!-- Important: Ajoute un ID "app" -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Product Ino</h5> <br>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <td>Product name</td>
                                        <td>{{ $product->name ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $product->category->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>{{ $product->brand->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>SKU </td>
                                        <td>{{ $product->sku ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cost price($)</td>
                                        <td>{{ $product->cost_price ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Retail price($)</td>
                                        <td>{{ $product->retail_price ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Year($)</td>
                                        <td>{{ $product->year ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description($)</td>
                                        <td>{{ $product->description ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status($)</td>
                                        <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="left: 20px; position: relative;" class="card-foote">
                                <a class="btn btn-sm btn-dark" href="{{route('products.index')}}"><i class="fa fa-arrow-left"></i>Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Image</h5> <br>
                            <div class="card-body text-center">
                                <img width="300px" src="{{ asset('storage/product_images/' . $product->image) }}" alt="{{ $product->name }}">

                                {{-- <img src="{{ asset('storage/product_images' . $product->image) }}"
                                    alt="{{ $product->name }}" style="width: 200px"> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Product stock</h5> <br>
                            <div class="card-body">
                                <table class="table table-sm table-bordered"> 
                                    @foreach ($product->product_stock as $p_stock )
                                    <tr>
                                        <td> {{$p_stock->size->size ?? ''}} </td>
                                        <td> {{$p_stock->location ?? ''}} </td>
                                        <td> {{$p_stock->quantity ?? 0}} </td>
                                    </tr>
                                        
                                    @endforeach
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

