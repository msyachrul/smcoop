@extends('layouts.layout')

@section('breadcrumb','Home')

@section('content')
	<div class="card mb-3">
		<div class="card-body">
			<div class="table-responsive">				
				<table class="table" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%"><b>No Anggota</b></td>
						<td width="1%">:</td>
						<td width="39%">{{ $anggota->no }}</td>
						<td><b>Total Simpanan</b></td>
						<td>:</td>
						<td>Rp {{ number_format($anggota->totalSimpanan) }}</td>
					</tr>
					<tr>
						<td><b>Nama</b></td>
						<td>:</td>
						<td>{{ $anggota->nama }}</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><b>Keanggotaan</b></td>
						<td>:</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endsection