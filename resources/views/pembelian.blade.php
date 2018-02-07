<?php date_default_timezone_set("Asia/Jakarta") ?>

@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')

      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
         <a href="#" class="inputPembelian">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus"></i>
              </div>
              <div class="mr-5">Input Pembelian</div>
            </div>
          </div>
      	 </a>
        </div>
      </div>
      <!-- Modal inputPembelian -->
    <div id="inputPembelian" class="modal fade" role="dialog">
      	<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h4 class="modal-title"></h4>
      				<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
      				<form class="form-horizontal" role="form">
      					<div class="form-group">
      						<label class="control-label col-sm-6">Tanggal</label>
      						<input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
      					</div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">ID Barang</label>
                  <input type="text" class="idBarang form-control" name="idBarang" disabled>
                </div>
      					<div class="form-group ui-front">
      						<label class="control-label col-sm-6">Nama Barang</label>
      						<input type="text" class="namaBarang form-control" name="namaBarang">
      					</div>
      				</form>
      			</div>
      		</div>
      	</div>
    </div>

@endsection