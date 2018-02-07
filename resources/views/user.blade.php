@extends('layouts.user-layout')

@section('breadcrumb','Dashboard')

@section('content')

	<div class="card mb-3">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%"><b>No Anggota</b></td>
						<td width="1%">:</td>
						<td width="39%">4152484127</td>
						<td><b>Total Simpanan</b></td>
						<td>:</td>
						<td>Rp 250.000</td>
					</tr>
					<tr>
						<td><b>Nama</b></td>
						<td>:</td>
						<td>Agung Nugraha</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><b>Keanggotaan</b></td>
						<td>:</td>
						<td>16 Bulan</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal</th>
							<th>No Transaksi</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>1/2/2018</td>
							<td>KRD201802010001</td>
							<td>Rp 15.000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>2/2/2018</td>
							<td>KRD201802020010</td>
							<td>Rp 9.000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>3/2/2018</td>
							<td>KRD201802010079</td>
							<td>Rp 20.000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>4/2/2018</td>
							<td>KRD201802010004</td>
							<td>Rp 5.000</td>
						</tr>
						<tr>
							<td>5</td>
							<td>5/2/2018</td>
							<td>KRD201802010011</td>
							<td>Rp 12.000</td>
						</tr>
						<tr>
							<td>6</td>
							<td>6/2/2018</td>
							<td>KRD201802010022</td>
							<td>Rp 8.000</td>
						</tr>
						<tr>
							<td>7</td>
							<td>7/2/2018</td>
							<td>KRD201802010011</td>
							<td>Rp 3.000</td>
						</tr>
						<tr>
							<td colspan="3"><b>Total Keseluruhan</b></td>
							<td><b>Rp 72.000</b></td>
						</tr>									
					</tbody>
				</table>
			</div>
		</div>
		
	</div>


@endsection