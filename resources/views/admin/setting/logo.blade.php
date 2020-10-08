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
						<form action="{{ url('appweb/config/logo') }}" method="POST" class="form-horizontal form-bordered form-row-stripped" id="formconfig" enctype="multipart/form-data">
							@csrf
							<div class="tabpanel">
                                <ul class="nav nav-tabs bar_tabs" role="tablist">
                                    <li class="active">
                                        <a href="#tab_logo" data-toggle="tab">
                                        Logo </a>
                                    </li>
                                </ul>
								<div class="tab-content no-space">
									<div class="tab-pane active" id="tab_logo">
										<div class="form-group ">
											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Logo:<span class="text-danger">*</span></label>
											<div class="col-md-10 col-xs-12">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 200px; height: 80px;">
														@empty($lg)
															<img src="{{ asset('img/no-image.png') }}" style="width:200px;height:80px;" alt="Logo"/>
														@else
															<img src="{{ asset('img/logo.png') }} " style="width:200px;height:80px;"  alt="Logo"/>
														@endempty
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 80px;"></div>
													<div>
														<span class="btn btn-primary btn-file">
															<span class="fileinput-new">Select image </span>
															<span class="fileinput-exists">Change </span>
															<input type="file" name="logo">
														</span>
														<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>
														<input type="hidden"  class="form-control" name="logolama" value="{{ $logo }}">
														<input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID">
													</div>
													<span class="help-block">Disarankan Nama file harus Logo.png</span> 
												</div>
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
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection