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
						<form action="{{  url('appweb/partner/create') }}" id="formpartner" class="form-horizontal form-bordered form-row-stripped" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="item form-group">
								<input class="form-control" type="hidden" id="id" name="id"  value="{{ $id }}">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Name:<span class="required">*</span></label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="text" id="judul" name="judul"  value="{{ $judul }}">
								</div>
							</div>
							<div class="item form-group ">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Gambar:<span class="text-danger">*</span></label>
								<div class="col-md-10 col-xs-12">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											@empty($image)
												<img src="{{ asset('img/no-image.png') }}" style="width:200px;height:150px;" alt=""/>
											@else
												<img src="{{ asset('img/'.$image) }}" style="width:200px;height:150px;"  alt=""/>
											@endempty
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
										<div>
											<span class="btn btn-primary btn-file">
												<span class="fileinput-new">Select image </span>
												<span class="fileinput-exists">Change </span>
												<input type="file" name="image">
											</span>
											<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>
											<input type="hidden"  class="form-control" name="imagelama" value="{{ $image }}">
											<span class="help-block"> Maksimal Size Gambar 1 mb</span>
										</div>
									</div>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-4 col-md-offset-8">
									<a href="{{ url('appweb/partner') }}" class="btn btn-primary" name="back"><i class="fa fa-angle-left"></i> Back</a>
									<button class="btn btn-success"  name="submit" ><i class="fa fa-check"></i> Save</button>
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
