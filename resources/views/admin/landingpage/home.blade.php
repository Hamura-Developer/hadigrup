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
						<form action="{{ url('appweb/linkhome') }}" class="form-horizontal form-bordered form-row-stripped" id="lhome" method="POST">
							@csrf
							
							<div class="tabpanel">
                                <ul class="nav nav-tabs bar_tabs" role="tablist">
									<li class="active">
										<a href="#tab_home" data-toggle="tab">
										Home </a>
									</li>
								</ul>
								<div class="tab-content no-space">
									<div class="tab-pane active" id="tab_home">
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Judul: <span class="required">* </span></label>
											<div class="col-md-10 col-xs-12">
												<input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID" readonly>
												<input type="text" class="form-control maxlength-handler" name="judul" id="judul" maxlength="70" value=" {{ $judul }}">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<textarea class="form-control maxlength-handler" name="deskripsi" rows="6" maxlength="2000">{{ $deskripsi }}</textarea>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Link: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<input type="text" class="form-control maxlength-handler" name="link" maxlength="100" value="{{ $link }}" placeholder="Link">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Text Link: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<input type="text" class="form-control maxlength-handler" name="textlink" maxlength="100" value="{{ $textlink }}" placeholder="Text Link">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-4 col-md-offset-8">
										<button class="btn btn-success"><i class="fa fa-check"></i> Save</button>
									</div>
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