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
						<form action="{{ url('appweb/abouts') }} " class="form-horizontal form-bordered form-row-stripped" id="formabouts" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="tabpanel">
								<div class="tab-content no-space">
									<div class="tab-pane active" id="tab_general">
										<div class="form-body">
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi Utama: <span class="required">* </span></label>
												<div class="col-md-10 col-xs-12">
													<input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID">
													<textarea class="form-control" id="ckeditor" name="deskripsi1" rows="6">{{$deskripsi1}}</textarea>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi Singkat: <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" id="ckeditor1" name="deskripsi2" rows="6" maxlength="500">{{$deskripsi2}}</textarea>
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
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Fitur 1: <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<input type="text" class="form-control maxlength-handler" name="judul1" maxlength="100" value="{{$judul1}}">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Keterangan : <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" name="text1" rows="6" maxlength="500">{{ $text1 }}</textarea>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Fitur 2: <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<input type="text" class="form-control maxlength-handler" name="judul2" maxlength="100" value="{{ $judul2 }}" >
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Keterangan : <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" name="text2" rows="6" maxlength="500">{{ $text2 }}</textarea>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Fitur 3: <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<input type="text" class="form-control maxlength-handler" name="judul3" maxlength="100" value="{{ $judul3 }}">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Keterangan : <span class="required"></span></label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" name="text3" rows="6" maxlength="500"> {{ $text3 }}</textarea>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Keywords:</label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" rows="8" name="meta_keyword" maxlength="300">{{ $meta_keyword }}</textarea>
													<span class="help-block">
													max 300 chars </span>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Description: <span class="required">
												</span></label>
												<div class="col-md-10 col-xs-12">
													<textarea class="form-control maxlength-handler" rows="8" name="meta_deskripsi" maxlength="160"> {{ $meta_deskripsi }}</textarea>
													<span class="help-block">
													max 160 chars </span>
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