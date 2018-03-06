@extends('layouts.layout')

@section('breadcrumb','Home')

@section('content')

<?php 

$data = session('data');
echo $data['no'].'<br>';
echo $data['nama'];

?>

@endsection