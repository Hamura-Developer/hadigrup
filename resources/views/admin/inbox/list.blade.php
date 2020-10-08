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
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mail<small>Inbox</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-3 mail_list_column">
                            <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
                            @foreach($datainbox as $inbox)
                            <a href="javascript:void(0);" id="view-message" onclick="viewmessage({{$inbox->id}})" @if($inbox->status =='0') {{ $status ="class=unread" }} @else {{ $status="" }} @endif data-messageid ="{{ $inbox->id }}" >
                                <div class="mail_list">
                                    <div class="left">
                                        <i class="fa fa-circle"></i>
                                    </div>
                                    <div class="right">
                                        <h3>{{ $inbox->nama }}<small>{{ Sistem::time_since($inbox->created_at) }}</small></h3>
                                        <p>{{ Str::limit($inbox->pesan,100) }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="inbox-loading">
                              
                        </div> 
                        <div class="inbox-content"></div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="compose col-md-6 col-xs-12">
    <div class="compose-header">
        Buat Pesan Baru
        <button type="button" class="close compose-close">
            <span>×</span>
        </button>
    </div>
    
	 <div class="compose-body">
        <label class="col-md-12 col-sm-12 col-xs-12 control-label">To:</label>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<input type="text" class="form-control input-group" name="to">
		</div>
   	    <label class="col-md-12 col-sm-12 col-xs-12 control-label">Subject:</label>
		<div class="col-md-12 col-sm-12 col-xs-12 controls">
			<input type="text" class="form-control input-group" name="subject">
		</div>
        <div id="alerts"></div>
        <div id="editor-ckeditor" class="editor-wrapper"></div>
    </div>
    <div class="compose-footer">
          <button id="send" class="btn btn-sm btn-success" type="button">Send</button>
    </div>
</div>
@endsection