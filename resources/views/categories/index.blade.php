@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Category List </li>
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
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add category</a> <br> <br>
                            <h5 class="card-title">Category List</h5> <br>
                            <table class="table table-bordered datatable">

                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categories)
                                        @foreach ($categories as $key => $category)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $category->name ?? '' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>Edit
                                                    </a>

                                                    <a href="javascipt:;"
                                                        class="btn btn-sm btn-danger sa-delete" data-form-id="category-delete-{{ $category->id }}">
                                                        <i class="fa fa-trash"></i>Delete
                                                    </a>
                                                    <form id="category-delete-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                    </form>

                                                </td>
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

