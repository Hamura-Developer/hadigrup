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
						<form action="{{ url('appweb/pages/create') }}" id="formpages" class="form-horizontal form-row-stripped form-bordered" method="POST">
							@csrf
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Nama Pages:<span class="text-danger">*</span></label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="hidden" name="id" id="id" value="{{ $id }}">
									<input class="form-control" type="text" name="pages" id="pages" value="{{ $pages }}">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Konten Pages:<span class="text-danger">*</span></label>
								<div class="col-md-10 col-xs-12">
									<textarea class="form-control" id="ckeditor" name="konten" >{{ $konten }}</textarea>
								</div>
							</div>
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Status: <span class="text-danger">*
								</span>
								</label>
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
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Posisi:<span class="text-danger">*</span></label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="text"  name="posisi" id="posisi" maxlength="4" value="{{ $posisi }}">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Layout: <span class="text-danger">
								</span>
								</label>
								<div class="col-md-10 col-xs-12">
									<select name="layout" class="table-group-action-input form-control select2me">
										@foreach ($dd_layout as $key => $value)
										<option value="{{ $key }}" {{ ( $key == $layout) ? 'selected' : $layout }}> 
											{{ $value }} 
										</option>
										@endforeach    
									</select>
								</div>
							</div>
							
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Keywords:</label>
								<div class="col-md-10 col-xs-12">
									<textarea class="form-control maxlength-handler" rows="8" name="meta_keyword" maxlength="300"> {{ $metakeyword }}</textarea>
									<span class="help-block">
									max 300 chars </span>
								</div>
							</div>
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Description: <span class="required">
								</span></label>
								<div class="col-md-10 col-xs-12">
									<textarea class="form-control maxlength-handler" rows="8" name="meta_deskripsi" maxlength="160">{{ $metadeskripsi }}</textarea>
									<span class="help-block">
									max 160 chars </span>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-4 col-md-offset-8">
									<a href="{{ url('appweb/pages') }}" class="btn btn-primary" name="back"><i class="fa fa-angle-left"></i> Back</a>
									<button class="btn btn-success" name="submit" ><i class="fa fa-check"></i> Save</button>
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