@foreach($viewinbox as $inbox)
<div class="col-sm-9 mail_view">
    <div class="inbox-body">
        <div class="mail_heading row">
            <div class="col-md-8">
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary reply-btn" type="button" data-messageid="{{ $inbox->id }}" ><i class="fa fa-reply"></i> Reply</button>
                    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <p class="date">{{ date('d F Y, H:i:s',strtotime($inbox->created_at)) }}</p>
            </div>
            <div class="col-md-12">
                <h4> {{ $inbox->subjek }}</h4>
            </div>
        </div>
        <div class="sender-info">
            <div class="row">
                <div class="col-md-12">
                <strong>{{ $inbox->nama }}</strong>
                <span>({{ $inbox->email }})</span> to
                <strong>me</strong>
                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
        </div>
        <div class="view-mail">
            {{ $inbox->pesan }}
        </div>
        <div class="btn-group">
            <button class="btn btn-sm btn-primary reply-btn" type="button" data-messageid="{{ $inbox->id }}"><i class="fa fa-reply"></i> Reply</button>
            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
</div>
@endforeach