@extends('layouts.layout')

@section('breadcrumb','Laporan')

@section('content')

	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-file"></i> Laporan
      	</div>
        <div class="card-body">
        	<div class="table-responsive">
        		<table class="table table-striped" width="100%" cellpadding="0" cellspacing="0">
        			<form>
	        			 <tr>
	        			 	<td>
	        			 		<label class="control-label col-sm">Dari :</label>
	        			 		<input type="date" class="form-control" name="dari">
	        			 	</td>
	        			 	<td>
	        			 		<label class="control-label col-sm">Sampai :</label>
	        			 		<input type="date" class="form-control" name="sampai">
	        			 	</td>
	        			 </tr>
	        		</form>
        		</table>
        	</div>
        </div>
    </div>

@endsection