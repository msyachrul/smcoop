@extends('layouts.layout')

@section('breadcrumb','Laporan')

@section('content')
    {{ csrf_field() }}
	<div class="card mb-3">
		@if(!isset($penjualan))
        <div class="card-header">
          <i class="fa fa-file"></i> Laporan
      	</div>
        <div class="card-body">
        	<div class="table-responsive">
        		<table class="table" width="100%" cellpadding="0" cellspacing="0">
        			<form method="POST" action="">
        				{{ csrf_field() }}
	        			 <tr>
                            <td colspan="3">
                                <label class="control-label col-sm">Anggota :</label>
                                <div class="form-row">
                                    <div class="col-sm-4">
                                        <input type="text" class="i_penjualanNoAnggota form-control" name="anggota_no" placeholder="Semua" readonly>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="i_penjualanNamaAnggota form-control" name="anggota_nama" placeholder="Nama Anggota" value="Semua" disabled>
                                    </div>
                                    <div class="enable_penjualanNamaAnggota col-sm-1">
                                        <a href="#" class="enable_penjualanNamaAnggota btn btn-info"><i class="fa fa-check"></i></a>
                                    </div>
                                </div>                               
                            </td>
                        </tr>
                        <tr>
	        			 	<td>
	        			 		<label class="control-label col-sm">Dari :</label>
	        			 		<input type="date" class="form-control" name="dari" required>
	        			 	</td>
	        			 	<td>
	        			 		<label class="control-label col-sm">Sampai :</label>
	        			 		<input type="date" class="form-control" name="sampai" required>
	        			 	</td>
	        			 	<td width="10%" style="vertical-align:bottom;">
	        			 		<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
	        			 	</td>
	        			 </tr>
	        		</form>
        		</table>
        	</div>
        </div>
        @else
        <div class="card-header">
          	<i class="fa fa-file"></i> Laporan
          	<div class="pull-right">
				<a href="{{ URL::asset('/admin/laporan/penjualan')}}" class="btn btn-success btn-sm"><i class="fa fa-angle-double-left"></i> Kembali</a>
			</div>
      	</div>
        <div class="card-body">
        	<div class="table-responsive">
        		<table class="table table-striped" width="100%">
        			<tr>
        				<td width="20%">Tanggal</td>
        				<td width="1%">:</td>
        				<td><b>{{ $tanggal['dari']." - ".$tanggal['sampai']}}</b></td>
        			</tr>
                    <tr>
                        <td>Nama Anggota</td>
                        <td>:</td>
                        <td><b>{{ $anggota }}</b></td>
                    </tr>
        			<tr>
        				<td>Jumlah Transaksi</td>
        				<td>:</td>
        				<td><b>{{ $transaksi }}</b></td>
        			</tr>
        			<tr>
        				<td>Total Transaksi</td>
        				<td>:</td>
        				<td><b>Rp {{ number_format($nominal) }}</b></td>
        			</tr>
        		</table>
        		<table class="table table-bordered" id="dataTable" width="100%" cellpadding="0" cellspacing="0">
        			<thead>
        				<tr>
        					<th width="5%">#</th>
        					<th>Tanggal</th>
        					<th>No Transaksi</th>
        					<th class="text-right">Total</th>
                            <th width="5%"></th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php $i=1; ?>
        				@foreach ($penjualan as $key => $value)
        				<tr>
        					<td>{{ $i++ }}</td>
        					<td>{{ $value->tanggal }}</td>
        					<td>{{ $value->no }}</td>
        					<td class="text-right">Rp {{ number_format($value->total) }}</td>
                            <td><a href="#" class="_modalDetail fa fa-eye" data-no="{{ $value->no }}"></a></td>
                        <!--     <td><a href="#{{ $value->no }}" class="detail fa fa-eye" data-toggle="collapse" data-no="{{ $value->no }}"></a></td>
        				</tr>
                        <tr class="collapse" id="{{ $value->no }}">
                            <td></td>
                            <td colspan="4">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Kuantitas</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list{{$value->no}}"></tbody>
                                </table>
                            </td>
                        </tr> -->
        				@endforeach
        			</tbody>
        		</table>
        	</div>
        </div>
        <div id="modalDetail" class="modal fade" role="dialog">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
    </div>


@endsection