@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Stock History </li>
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
                            <h5 class="card-title">Stock History</h5> <br>

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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stocks)
                                        @foreach ($stocks as $key => $stock)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $stock->date ?? '' }}</td>
                                                <td>{{ $stock->product->name ?? '' }}</td>
                                                <td>{{ $stock->size->size ?? '' }}</td>
                                                <td>{{ $stock->quantity ?? '' }}</td>
                                                <td>{{ strtoupper($stock->status) ?? '' }}</td>
                                               
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

