<?php
	$bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
?>
@extends('layouts.layout')

@section('breadcrumb','Tagihan')

@section('content')
	
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-file"></i> Tagihan
			<a href="#" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#CariTagihan"><i class="fa fa-search"></i> Cari</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				@if(isset($data))
				<table class="table table-striped" width="100%">
        			<tr>
        				<td width="20%">Periode</td>
        				<td width="1%">:</td>
        				<td><b>{{ $bulan[$periode-1]." ".$tahun }}</b></td>
        			</tr>
                    <tr>
                        <td>Nama Anggota</td>
                        <td>:</td>
                        <td><b>{{ $data['anggota'] }}</b></td>
                    </tr>
        			<tr>
        				<td>Jumlah Transaksi</td>
        				<td>:</td>
        				<td><b>{{ $data['transaksi'] }}</b></td>
        			</tr>
        			<tr>
        				<td>Total Transaksi</td>
        				<td>:</td>
        				<td><b>Rp {{ number_format($data['total']) }}</b></td>
        			</tr>
        		</table>
        		@endif
				<table class="table table-bordered" id="dataTable" width="100%">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>Tanggal</th>
							<th>No Transaksi</th>
							<th class="text-right">Total</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
					@if(isset($pembelian))
						<?php $i=1; ?>
						@foreach ($pembelian as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->tanggal }}</td>
							<td>{{ $value->no }}</td>
							<td class="text-right">Rp {{ number_format($value->total) }}</td>
							<td><a href="#" class="_modalDetailUser fa fa-eye" data-no="{{ $value->no }}"></a></td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal Cari Tagihan -->
	<div id="CariTagihan" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cari Tagihan</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
				<form method="POST" action="">
                {{ csrf_field() }}
 	            <div class="form-group row">
 	              	<label class="col-sm-2 col-form-label">Periode</label>
 	              	<div class="col-sm">
 	              		<select name="periode" class="form-control">
 	              			<option value="" hidden>Pilih Bulan</option>
 	              			@foreach($bulan as $key => $value)
 	              				<option value="{{ $key+1 }}">{{ $value }}</option>
 	              			@endforeach
 	              		</select>
 	              	</div>
 	              	<div class="col-sm">
 	              		<select name="tahun" class="form-control">
 	              			<option value="" hidden>Pilih Tahun</option>
	 	              		@for($i=date('Y');$i>=2016;$i--)
	 	              			<option value="{{ $i }}">{{ $i }}</option>
	 	              		@endfor
 	              		 </select>
 	              	</div>
 	              </div>
 	              <div class="form-group row">
 	              	<div class="col-sm">
 	              		<div class="pull-right">
 	              			<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
             				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
             			</div>
 	              	</div>
                </div>
	        	</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal DetailTransaksi -->
        <div id="modalDetailUser" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th class="text-right">Harga</th>
                                        <th class="text-right">Kuantitas</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="list"></tbody>
                                <tfoot>
			                        <tr>
			                            <td class="text-right" colspan="3"><b>Total</b></td>
			                            <td id="total" class="text-right"></td>
			                        </tr>
			                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection