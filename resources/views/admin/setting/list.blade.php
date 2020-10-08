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
                        <form action='config' method="POST" class="form-horizontal form-bordered form-row-stripped" id="formconfig" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" readonly="true" class="form-control" name="id" id="id" value="{{ $id }}" placeholder="ID">
                            <div class="tabpanel">
                                <ul class="nav nav-tabs bar_tabs" role="tablist">
                                    <li class="active">
                                        <a href="#tab_general" data-toggle="tab">
                                        General </a>
                                    </li>
                                    <li>
                                        <a href="#tab_data" data-toggle="tab">
                                        Data </a>
                                    </li>
                                    <li>
                                        <a href="#tab_meta" data-toggle="tab">
                                        Meta </a>
                                    </li>
                                    <li>
                                        <a href="#tab_images" data-toggle="tab">
                                        Images </a>
                                    </li>
                                    <li>
                                        <a href="#tab_social" data-toggle="tab">
                                        Social </a>
                                    </li>
                                </ul>
                                <div class="tab-content no-space">
                                    <div class="tab-pane active" id="tab_general">
                                        <div class="item form-group">
                                            <label class="control-label col-md-2">URL Homepage</label>
                                            <div class="col-md-10 col-xs-12">
                                                <input id="website" name="website" type="text" class="form-control" id="url" value="{{ $web }}" />
                                                <span class="help-block">
                                                e.g: http://www.demo.com or http://demo.com </span>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Judul Situs: <span class="required">* </span></label>
                                            <div class="col-md-10 col-xs-12">
                                                <input type="text" class="form-control maxlength-handler" name="nama" id="nama" maxlength="70" value="{{ $nama }}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Slogan: <span class="required"></span></label>
                                            <div class="col-md-10 col-xs-12">
                                                <input type="text" class="form-control maxlength-handler" name="slogan" maxlength="100" value="{{ $slog }}" placeholder="Slogan">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Deskripsi Situs: <span class="required"></span></label>
                                            <div class="col-md-10 col-xs-12">
                                                <textarea class="form-control maxlength-handler" name="deskripsi_situs" rows="6" maxlength="500"> {{ $deskripsi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_data">
                                        <div class="form-body">
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Telepon: <span class="required"> </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control maxlength-handler" name="telepon" id="telepon" maxlength="13" value="{{ $telp }}" placeholder="Telepon">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Alamat: <span class="required"></span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <textarea class="form-control maxlength-handler" rows="8" name="alamat" maxlength="300">{{ $almt }}</textarea>
                                                    <span class="help-block">
                                                    max 300 chars </span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Email Web: <span class="required"></span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control maxlength-handler" rows="8" id="email" value="{{ $email }}" name="email_website" maxlength="50"/>
                                                    <input id="pemilik" name="pemilik" value="Ervin Santoso" type="hidden" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_meta">
                                        <div class="form-body">
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Keywords:</label>
                                                <div class="col-md-10 col-xs-12">
                                                    <textarea class="form-control maxlength-handler" rows="8" name="meta_keyword" maxlength="300">{{ $mekeyword }}</textarea>
                                                    <span class="help-block">
                                                    max 300 chars </span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Meta Description: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <textarea class="form-control maxlength-handler" rows="8" name="meta_deskripsi" maxlength="160">{{ $medeskripsi }}</textarea>
                                                    <span class="help-block">
                                                    max 160 chars </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_images">
                                        <div class="item form-group ">
                                            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Favicon:<span class="text-danger">*</span></label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 64px; height: 64px;">
                                                        @empty($fvc) 
                                                            <img src="{{ asset('img/no-image.png') }} " style="width:64px;height:64px;" alt="favicon"/>
                                                        @else
                                                            <img src="{{ asset('img/'.$fvc.'') }}" style="width:64px;height:64px;"  alt="favicon"/>
                                                        @endempty
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 64px; max-height: 64px;"></div>
                                                    <div>
                                                        <span class="btn btn-primary btn-file">
                                                            <span class="fileinput-new">Select image </span>
                                                            <span class="fileinput-exists">Change </span>
                                                            <input type="file" name="favicon">
                                                        </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>
                                                        <input type="hidden"  class="form-control" name="faviconlama" value="{{ $favicon }}">
                                                    </div>
                                                    <span class="help-block">nama file harus favicon.png</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_social">
                                        <div class="form-body">
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Facebook: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control" name="facebook" value="{{ $facebook }}" placeholder="">
                                                    <span class="help-block">
                                                    Contoh :bangipin15</span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Instagram: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control" name="instagram"  value="{{ $instagram }}" placeholder="">
                                                    <span class="help-block">
                                                    Contoh : bangipin15</span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Linked In: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control " name="linkedin" value="{{ $linkedin }}" placeholder="">
                                                    <span class="help-block">
                                                    Contoh :bangipin15</span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Twitter: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control " name="twitter" value="{{ $twitter }}" placeholder="">
                                                    <span class="help-block">
                                                    Contoh :bangipin15</span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Youtube: <span class="required">
                                                </span></label>
                                                <div class="col-md-10 col-xs-12">
                                                    <input type="text" class="form-control" name="youtube" value="{{ $youtube }}" placeholder="">
                                                    <span class="help-block">
                                                    Masukkan Username Youtube </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="ln_solid"></div>
							<div class="item item form-group">
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