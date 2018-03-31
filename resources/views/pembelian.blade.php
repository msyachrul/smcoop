@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')

	{{ csrf_field() }}
	<div class="card mb-3">
		<div class="card-header">
          <i class="fa fa-file"></i> Pembelian
          <a href="#" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#cariPembelian"><i class="fa fa-search"></i> Cari</a>
      	</div>
        <div class="card-body">
        	<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0">
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
					@if(isset($pembelian))
						<?php $i=1; ?>
						@foreach($pembelian as $key => $value)
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
	<!-- Modal pilih tanggal -->
    <div id="cariPembelian" class="modal fade" role="dialog">
      	<form method="POST" action="" class="form-horizontal">
      	<div class="modal-dialog">
        	<div class="modal-content">
          		<div class="modal-header">
		            <h4 class="modal-title">Cari Pembelian</h4>
        		    <button type="button" class="close" data-dismiss="modal">&times;</button>
          		</div>
          		<div class="modal-body">
	            	{{ csrf_field() }}
					<div class="form-group row">
						<label class="col-sm col-form-label">Dari</label>
						<div class="col-sm">
							<input type="number" name="dariTanggal" class="form-control" placeholder="DD">
						</div>
						<div class="col-sm">
							<input type="number" name="dariBulan" class="form-control" placeholder="MM">
						</div>
						<div class="col-sm">
							<input type="number" name="dariTahun" class="form-control" placeholder="YYYY">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm col-form-label">Sampai</label>
						<div class="col-sm">
							<input type="number" name="sampaiTanggal" class="form-control" placeholder="DD">
						</div>
						<div class="col-sm">
							<input type="number" name="sampaiBulan" class="form-control" placeholder="MM">
						</div>
						<div class="col-sm">
							<input type="number" name="sampaiTahun" class="form-control" placeholder="YYYY">
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
          		</div>
        	</div>
      	</div>
      	</form>
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