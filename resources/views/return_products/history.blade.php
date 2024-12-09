@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Return Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Return Product History </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div id="app" class="content"> <!-- Important: Ajoute l'ID "app" ici -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Rteurn Product History</h5> <br>

                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add category</a> <br> <br>

                            <!-- Le composant Vue va être monté ici -->
                            <exemple-component></exemple-component>

                            <table class="table table-bordered datatable">

                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($return_products)
                                        @foreach ($return_products as $key => $return_product)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $return_product->date ?? '' }}</td>
                                                <td>{{ $return_product->product->name ?? '' }}</td>
                                                <td>{{ $return_product->size->size ?? '' }}</td>
                                                <td>{{ $return_product->quantity ?? '' }}</td>
                                               
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div><!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

