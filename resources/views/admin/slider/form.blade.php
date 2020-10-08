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
						<form action="{{ route('sliders.create') }}" id= "formslider" method="POST" class= "form-horizontal form-row-stripped form-bordered" enctype="multipart/form-data">
							@csrf
							<div class="item form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Nama:</label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="hidden" id="id" value="{{ $id }}" name="id" readonly>
									<input class="form-control" type="text" id="name" value="{{ $name }}" name="name">
								</div>
							</div>
							<div class="item form-group ">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Gambar:<span class="text-danger"></span></label>
								<div class="col-md-10 col-xs-12">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
											@empty($image)
												<img src="{{ asset('img/no-image.png') }}" alt=""/>
											@else
												<img src="{{ asset('img/'.$image) }}" alt=""/>
											@endempty
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
											<span class="btn btn-primary btn-file">
												<span class="fileinput-new">Select image </span>
												<span class="fileinput-exists">Change </span>
												<input type="file" name="image">
											</span>
											<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>
											<input type="hidden"  class="form-control" name="imagelama" value="{{ $image }}">
											<span class="help-block"> Maksimal Size Gambar 2 mb</span>
										</div>
									</div>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Status: <span class="required">
								* </span>
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
								<label class="control-label col-md-2 col-sm-2 col-xs-12">URL:</label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="text" id="link" value="{{ $link }}" name="link">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-4 col-md-offset-8">
									<a href="{{ url('appweb/sliders') }}" class="btn btn-primary" name="back"><i class="fa fa-angle-left"></i> Back</a>
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