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
						<form action="{{ url('appweb/tags/create') }}" id= "form_tag" class="form-horizontal form-bordered form-row-stripped" method="POST">
							@csrf
							<div class="item form-group">
								<label class="col-md-2 col-sm-2 col-xs-12 control-label">Tag <span class="required">*</span></label>
								<div class="col-md-10 col-xs-12">
									<input class="form-control" type="hidden" id="id" name="id" value="{{ $id }}" />
									<input class="form-control" type="text" id="tags" name="tags" value=" {{ $tags }}" />
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-4 col-md-offset-8">
									<a href="{{ url('appweb/tags') }}" class="btn btn-primary" name="back"><i class="fa fa-angle-left"></i> Back</a>
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