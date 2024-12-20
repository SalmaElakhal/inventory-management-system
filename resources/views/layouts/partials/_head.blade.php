<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>

{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href= "{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    .select2-container--default {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 38px!important;
    }
</style>


@stack('css')
