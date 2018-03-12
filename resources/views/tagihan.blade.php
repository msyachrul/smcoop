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
		                <td><b>{{ date('F Y')}}</b></td>
		              </tr>
				</table>
			</div>
			
		</div>
	</div>

@endsection