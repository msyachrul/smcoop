<?php date_default_timezone_set("Asia/Jakarta"); ?>

@extends('layouts.layout')

@section('breadcrumb','Penjualan')

@section('content')

      {{ csrf_field() }}
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Penjualan <span id="keteranganTanggal"></span>
          <div class="pull-right">
            <a href="#" class="cariPenjualan btn btn-success btn-sm"><i class="fa fa-search"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Tanggal</th>
                  <th>No Penjualan</th>
                  <th class="text-right">Total</th>
                  <th width="15%" class="text-center">
                    <a href="{{ URL::asset('penjualan/input') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  </th>
                </tr>
              </thead>
              <tbody id="tbodyCari">
                <?php $no=1; ?>
                @foreach ( $penjualan as $key => $value )
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $value->tanggal }}</td>
                  <td>{{ $value->noPenjualan }}</td>
                  <td class="text-right">Rp {{ number_format($value->total) }}</td>
                  <td>
                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <!-- Modal pilih tanggal -->
    <div id="cariPenjualan" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-sm-6">Dari</label>
                  <input type="date" class="form-control" name="dariTanggal" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Sampai</label>
                  <input type="date" class="form-control" name="sampaiTanggal" placeholder="YYYY-MM-DD" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info" id="_cariPenjualan">
                <span class="fa fa-search"></span> Cari
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="fa fa-close"></span> Batal
              </button>
            </div>
        </div>
      </div>
    </div>

@endsection