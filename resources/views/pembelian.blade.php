@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')

	{{ csrf_field() }}
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Data Pembelian
		</div>
		<div class="card-body">
			<div class="table-responsive">
            <table class="table table-striped" width="100%">
              <tr>
                <td width="20%">Tanggal</td>
                <td width="1%">:</td>
                <td><b>{{ date('Y-m-d') }}</b></td>
              </tr>
            </table>
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
						<?php $i=1; ?>
						@foreach($penjualan as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->tanggal }}</td>
							<td>{{ $value->no }}</td>
							<td class="text-right">Rp {{ number_format($value->total) }}</td>
							<!-- <td><a href="{{ URL::asset('/pembelian/'.$value->no) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></td> -->
							<td><a href="#" class="_modalDetailUser fa fa-eye" data-no="{{ $value->no }}"></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection