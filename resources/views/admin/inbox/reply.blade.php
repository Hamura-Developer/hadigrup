
@foreach($viewinbox as $inbx)
<div class="col-sm-9 mail_view">
    <div class="inbox-body">
		<form action="{{ url('appweb/inbox/sendemail') }}" class="inbox-compose form-horizontal" id="fileupload" method="POST" enctype="multipart/form-data" >
			<div class="inbox-form-group mail-to">
				<label class="control-label">To:</label>
				<div class="controls controls-to">
					<input type="text" class="form-control" name="to" value="{{ $inbx->email }}">
				</div>
			</div>
			<div class="inbox-form-group">
				<label class="control-label">Subject:</label>
				<div class="controls">
					<input type="text" class="form-control" name="subject" value="Balasan dari subjek &nbsp;` {{ $inbx->subjek }} ` ">
				</div>
			</div>
			<div class="inbox-form-group">
				<label class="control-label">Balasan:</label>
				<div class="controls-row">
					<textarea class="inbox-editor form-control" id="editor-ckeditor" name="message" rows="12"></textarea>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="item form-group">
				<div class="col-md-4 col-md-offset-0">
					<button class="btn btn-md btn-success"><i class="fa fa-check"></i>Send</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach
<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
	 var url = "{{ url('/ckfinder/ckfinder.html') }}";
	CKEDITOR.replace('editor-ckeditor',{
		filebrowserBrowseUrl: url,
		filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        height:200
	});s	
</script>
