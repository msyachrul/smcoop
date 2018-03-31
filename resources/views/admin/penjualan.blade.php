<?php date_default_timezone_set("Asia/Jakarta"); ?>

@extends('layouts.layout')

@section('breadcrumb','Penjualan')

@section('content')

      {{ csrf_field() }}
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Penjualan
          <div class="pull-right">
            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cariPenjualan"><i class="fa fa-search"></i> Cari</a>
          </div>
        </div>
        <div class="card-body">
          @if(isset($tanggal))
          <div class="table-responsive">
            <table class="table table-striped" width="100%">
              <tr>
                <td width="20%">Tanggal</td>
                <td width="1%">:</td>
                <td><b>{{ $tanggal['dari']." - ".$tanggal['sampai']}}</b></td>
              </tr>
            </table>
          @else
          <div class="table-responsive">
            <table class="table table-striped" width="100%">
              <tr>
                <td width="20%">Tanggal</td>
                <td width="1%">:</td>
                <td><b>{{ date('Y-m-d') }}</b></td>
              </tr>
            </table>
          @endif
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Tanggal</th>
                  <th>No Penjualan</th>
                  <th>No Anggota</th>
                  <th width="20%" class="text-right">Total</th>
                  <th width="15%" class="text-center">
                    <a href="{{ URL::asset('/admin/penjualan/input') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  </th>
                </tr>
              </thead>
              <tbody id="tbodyCari">
                <?php $no=1; ?>
                @foreach ( $penjualan as $key => $value )
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $value->tanggal }}</td>
                  <td>{{ $value->no }}</td>
                  <td>{{ $value->anggota_no }}</td>
                  <td class="text-right">Rp {{ number_format($value->total) }}</td>
                  <td>
                    <a href="{{ URL::asset('/admin/penjualan/'.$value->no) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{ URL::asset('/admin/penjualan/edit/'.$value->no) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="{{ URL::asset('/admin/penjualan/hapus/'.$value->no) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin hapus data penjualan {{$value->no}}?')"><i class="fa fa-trash"></i></a>
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
      <form method="POST" action="" class="form-horizontal" role="form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Cari Penjualan</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            {{ csrf_field() }}
            <div class="form-row">
              <label class="form-group col-sm col-form-label">Dari</label>
              <div class="form-group col-sm">
                <input type="number" name="dariTanggal" class="form-control" placeholder="DD">
              </div>
              <div class="form-group col-sm">
                <input type="number" name="dariBulan" class="form-control" placeholder="MM">
              </div>
              <div class="form-group col-sm">
                <input type="number" name="dariTahun" class="form-control" placeholder="YYYY">
              </div>
            </div>
            <div class="form-row">
              <label class="form-group col-sm col-form-label">Sampai</label>
              <div class="form-group col-sm">
                <input type="number" name="sampaiTanggal" class="form-control" placeholder="DD">
              </div>
              <div class="form-group col-sm">
                <input type="number" name="sampaiBulan" class="form-control" placeholder="MM">
              </div>
              <div class="form-group col-sm">
                <input type="number" name="sampaiTahun" class="form-control" placeholder="YYYY">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>  
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </div>
        </div>
      </div>
      </form>
    </div>

@endsection