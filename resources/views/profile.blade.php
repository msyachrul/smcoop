@extends('layouts.layout')

@section('breadcrumb','Profile')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Data Anggota
			<div class="pull-right">
				<button type="button" class="edit btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
			</div>
		</div>
		<div class="card-body">
			@if(isset($info))
				<div class="form-group">
					<div class="col-sm text-center">
						<b>{{ $info }}</b>
					</div>
				</div>
			@endif
			<form class="form-horizontal" method="post" action="">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Nomor Anggota</label>
						<div class="form-control">
							{{ $anggota->no }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Nama</label>
						<input type="text" class="nama form-control" name="nama" value="{{ $anggota->nama }}" disabled required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Departemen</label>
						<select class="departemen form-control" name="departemen" disabled required>
	                      <option value="{{ $anggota->departemen }}" selected hidden>{{ $anggota->departemen }}</option>
	                      <option value="A & G">A & G</option>
	                      <option value="Accounting">Accounting</option>
	                      <option value="Engineering">Engineering</option>
	                      <option value="Food & Beverage">Food & Beverage</option>
	                      <option value="Human Resource">Human Resource</option>
	                      <option value="Housekeeping">Housekeeping</option>
	                      <option value="Sales & Marketing">Sales & Marketing</option>
                    	</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Posisi</label>
						<input type="text" class="form-control" name="posisi" value="{{ $anggota->posisi }}" disabled required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Total Simpanan</label>
						<div class="form-control">
							Rp {{ number_format($anggota->totalSimpanan) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<div class="pull-right">
							<button type="submit" class="update btn btn-primary" disabled><i class="fa fa-check"></i> Update</button>
							<button type="button" class="batal btn btn-danger" disabled onclick="location.reload()"><i class="fa fa-close"></i> Batal</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection