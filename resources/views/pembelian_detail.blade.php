@extends('layouts.layout')

@section('breadcrumb','Pembelian / detail')

@section('content')

	<div class="card mb-3">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="15%"><b>No Transaksi</b></td>
						<td width="1%">:</td>
						<td>{{ $pembelian->no }}</td>
						<td class="text-right"><b>Tanggal</b></td>
						<td width="1%">:</td>
						<td width="15%">{{ $pembelian->tanggal }}</td>
					</tr>
				</table>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nama</th>
							<th class="text-right">Harga</th>
							<th class="text-right">Kuantitas</th>
							<th class="text-right">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($detail as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">Rp {{ number_format($value->harga) }}</td>
							<td class="text-right">{{ $value->kuantitas }}</td>
							<td class="text-right">Rp {{ number_format($value->subTotal) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection