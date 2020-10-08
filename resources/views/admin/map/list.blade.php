@extends('layouts.admin')

@section('title')
	<title> {{ $title }} </title>
	@endsection
@section('section')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>{{ $title }} <small></small></h3>
		</div>

	</div>

	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="row">
					<div class="x_content">
						<form action="{{ url('appweb/maps') }}" class="form-horizontal form-row-seperated form-bordered form-label-stripped" id="formlokasi" method="POST">
							@csrf
							<div class="form-body">
								<input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID">
								<div class="item form-group">
									<label class="col-md-2 col-sm-2 col-xs-12 control-label">Name: <span class="required">* </span></label>
									<div class="col-md-10 col-xs-12">
										<input type="text" class="form-control maxlength-handler" name="nama" id="nama" maxlength="50" value="{{ $nama }}">
									</div>
								</div>
								<div class="item form-group">
									<label class="col-md-2 col-sm-2 col-xs-12 control-label">Content: <span class="required">*</span></label>
									<div class="col-md-10 col-xs-12">
										<input type="text" class="form-control maxlength-handler" name="caption" id="caption" maxlength="200" value="{{  $caption }}">
									</div>
								</div>
								<div class="item form-group">
									<label class="col-md-2 col-sm-2 col-xs-12 control-label">Embed Maps: <span class="required">*</span></label>
									<div class="col-md-10 col-xs-12">
										<textarea class="form-control" rows="8"name="embed" id="embed">{{ $embed }}</textarea>
									</div>
								</div>
								<div class="item form-group">
									<label class="col-md-2 col-sm-2 col-xs-12 control-label">Status: <span class="required">* </span></label>
									<div class="col-md-10 col-xs-12">
										<select name="status" class="table-group-action-input form-control select2me">
											@foreach ($dd_status as $key => $value)
											<option value="{{ $key }}" {{ ( $key == $status) ? 'selected' : $status }}> 
												{{ $value }} 
											</option>
											@endforeach    
										</select>
									</div>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-4 col-md-offset-8">
									<button class="btn btn-success"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection