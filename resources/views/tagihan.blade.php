@extends('layouts.layout')

@section('breadcrumb','Tagihan')

@section('content')
	
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-file"></i> Tagihan
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<tr>
		                <td width="20%">Periode</td>
		                <td width="1%">:</td>
		                <td><b>{{ date('Y-m-18',strtotime('last Month'))." - ".date('Y-m-17') }}</b></td>
		              </tr>
				</table>
				<table class="table table-bordered" id="dataTable" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal</th>
							<th>No Transaksi</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach ($pembelian as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->tanggal }}</td>
							<td>{{ $value->no }}</td>
							<td>{{ $value->total }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection