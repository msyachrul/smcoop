@extends('layouts.layout')

@section('breadcrumb','Home')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Data Anggota
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Nomor</label>
						<input type="text" class="no form-control" name="no" value="{{ $anggota->no }}" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Nama</label>
						<input type="text" class="nama form-control" name="nama" value="{{ $anggota->nama }}" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Departemen</label>
						<select class="departemen form-control" name="departemen" disabled>
	                      <option value="null" disabled selected hidden>{{ $anggota->departemen }}</option>
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
						<input type="text" class="form-control" name="posisi" value="{{ $anggota->posisi }}" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<label class="control-label col-sm">Total Simpanan</label>
						<input type="text" class="form-control" name="totalsimpanan" value="{{ $anggota->totalSimpanan }}" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm">
						<div class="pull-right">
							<button type="submit" class="update btn btn-primary" disabled><i class="fa fa-check"></i> Update</button>
							<button type="button" class="edit btn btn-info"><i class="fa fa-pencil"></i> Edit</button>
							<button type="button" class="batal btn btn-danger" disabled><i class="fa fa-close"></i> Batal</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection