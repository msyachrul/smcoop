@extends('layouts.layout')

@section('breadcrumb','Barang')

@section('content')	

	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Data Barang
		</div>
		<div class="card-body">
			<div class="table-responsive" id="reloadTable">
				<table class="table table-bordered" id="barangTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nama</th>
							<th width="20%" class="text-right">Harga</th>
							<th width="10%" class="text-center">
								<a href="#" class="daftarBarang btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
							</th> 
						</tr>
					</thead>
					{{ csrf_field() }}
					<tbody>
						<?php $i=1; ?>
						@foreach( $barang as $key => $value )
						<tr class="barang{{ $value->id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">Rp {{ number_format($value->harga) }}</td>
							<!-- Trigger Modal -->
							<td class="text-center">
								<a href="#" class="editBarang btn btn-info btn-sm" data-id="{{ $value->id }}" data-nama="{{ $value->nama }}" data-harga="{{ $value->harga }}"><i class="fa fa-pencil"></i></a>
								<a href="#" class="hapusBarang btn btn-danger btn-sm" data-id="{{ $value->id }}" data-nama="{{ $value->nama }}" data-harga="{{ $value->harga }}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>					
				</table>
			</div>
		</div>
	</div>

	<!-- Modal tambahBarang -->
	<div id="daftarBarang" class="modal fade" role="dialog">
		<!-- <form class="form-horizontal" role="form" id="tambahBarang"> -->
		<form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/barang/daftar')}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Nama</label>
					 	{{ csrf_field() }}
					 	<input type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Harga</label>
					 	<input type="number" class="form-control" name="harga" placeholder="Harga Barang" required>
					 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">
					 <span class="fa fa-plus"></span> Tambah
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
					 <span class="fa fa-close"></span> Batal
					</button>
				</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- Modal editBarang -->
	<div id="editBarang" class="modal fade" role="dialog">
		<form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/barang/edit')}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					 <div class="form-group">
					 	<label class="control-label col-sm-4">No Barang</label>
					 	{{ csrf_field() }}
						<input type="text" class="form-control" name="id" readonly>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Nama</label>
					 	<input type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Harga</label>
					 	<input type="number" class="form-control" name="harga" placeholder="Harga Barang" required>
					 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
					 <span class="fa fa-check"></span> Update
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
					 <span class="fa fa-close"></span> Batal
					</button>
				</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- Modal hapusBarang -->
	<div id="hapusBarang" class="modal fade" role="dialog">
		<form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/barang/hapus')}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					 <div class="form-group">
					 	<label class="control-label col-sm-12 text-center"><b>Apakah anda yakin menghapus barang ini?</b></label>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-4">No Barang</label>
					 	{{ csrf_field() }}
						<input type="text" class="form-control" name="id" id="hapusId" readonly>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Nama</label>
					 	<input type="text" class="form-control" name="nama" id="hapusNama" placeholder="Nama Barang" readonly>
					 </div>
					 <div class="form-group">
					 	<label class="control-label col-sm-8">Harga</label>
					 	<input type="number" class="form-control" name="harga" id="hapusHarga" placeholder="Harga Barang" readonly>
					 </div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">
					 <span class="fa fa-trash"></span> Hapus
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
					 <span class="fa fa-close"></span> Batal
					</button>
				</div>
				</div>
			</div>
		</div>
		</form>
	</div>

@endsection