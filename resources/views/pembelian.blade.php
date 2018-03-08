@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Daftar Pembelian
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
						<?php $i=1; ?>
						@foreach($penjualan as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->tanggal }}</td>
							<td>{{ $value->no }}</td>
							<td class="text-right">Rp {{ number_format($value->total) }}</td>
							<td><a href="{{ URL::asset('/pembelian/'.$value->no) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection