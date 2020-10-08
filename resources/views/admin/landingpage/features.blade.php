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
						<form action="{{ url('appweb/linkfeatures') }}" class="form-horizontal form-bordered form-row-stripped" id="formfeatures" method="POST">
							@csrf
							<div class="tabpanel">
                                <ul class="nav nav-tabs bar_tabs" role="tablist">
									<li class="active">
										<a href="#tab_features" data-toggle="tab">
										Fitur </a>
									</li>
								</ul>
								<div class="tab-content no-space">
									<div class="tab-pane active" id="tab_features">
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Nama: <span class="required"> </span></label>
											<div class="col-md-10 col-xs-12">
												<input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID" readonly>
												<input type="text" class="form-control" name="judulfitur1" id="judulfitur1" value="{{ $judulfitur1 }}" placeholder="Nama">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<textarea class="form-control maxlength-handler" rows="8" name="konten1" maxlength="300">{{ $konten1 }}</textarea>
												<span class="help-block">
												max 300 chars </span>
											</div>
										</div>
										<hr/>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Nama: <span class="required"> </span></label>
											<div class="col-md-10 col-xs-12">
												<input type="text" class="form-control " name="judulfitur2" id="judulfitur2" value="{{ $judulfitur2 }}" placeholder="Nama">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<textarea class="form-control maxlength-handler" rows="8" name="konten2" maxlength="300">{{ $konten2 }}</textarea>
												<span class="help-block">
												max 300 chars </span>
											</div>
										</div>
										<hr/>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Nama : <span class="required"> </span></label>
											<div class="col-md-10 col-xs-12">
												<input type="text" class="form-control" name="judulfitur3" id="judulfitur3" value="{{ $judulfitur3 }}" placeholder="Nama">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi: <span class="required"></span></label>
											<div class="col-md-10 col-xs-12">
												<textarea class="form-control maxlength-handler" rows="8" name="konten3" maxlength="300">{{ $konten3 }}</textarea>
												<span class="help-block">
												max 300 chars </span>
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