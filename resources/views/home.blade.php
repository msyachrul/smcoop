@extends('layouts.layout')

@section('breadcrumb','Home')

@section('content')

{{ session('data')['no'] }}
<br>
{{ session('data')['nama'] }}
@endsection