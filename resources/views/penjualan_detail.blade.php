@extends('layouts.layout')

@section('breadcrumb','Penjualan/Detail')

@section('content')

	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Detail Penjualan Nomor {{ $detail[0]->noPenjualan }}
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nama</th>
							<th class="text-right">Harga</th>
							<th class="text-right">Kuantitas</th>
							<th class="text-right">SubTotal</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($detail as $key => $value)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">Rp {{ number_format($value->harga) }}</td>
							<td class="text-right">{{ $value->kuantitas }}</td>
							<td class="text-right">Rp {{ number_format($value->subTotal) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="card-footer">
					<div class="card-text pull-right">
						<b>Total : Rp {{ number_format($total) }}</b>
					</div>
				</div>
			</div>
		</div>
	</div>

	

@endsection