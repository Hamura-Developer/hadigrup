@if (session('SUCCESSMSG'))
		<div role="alert" class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
			<strong>Sukses!</strong>
			{{ session('SUCCESSMSG') }}
		</div>
	@endif
	@if (session('GAGALMSG'))
		<div role="alert" class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
			{{ session('GAGALMSG') }}
		</div>
	@endif
<table id="inboxall" class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th>
				No
			</th>
			<th>
				Name
			</th>
			<th>
				Subjek
			</th>
			<th>
				Pesan
			</th>
			<th >
				Waktu
			</th>
			<th>
				Aksi
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datainbox as $inbox)
		<tr @if($inbox->status =='0') {{ $status ="class=unread" }} @else {{ $status="" }} @endif data-messageid ="{{ $inbox->id }}">
			<td width="5%">
					{{ $loop->iteration }}
			</td>
			<td class="view-message">
					{{ $inbox->nama }}
			</td>
			<td class="view-message">
					 {{ $inbox->subjek }}
			</td>
			<td class="view-message">
					 {{ Str::limit($inbox->pesan,30) }}
			</td>
			<td width="25%" class="view-message">
				{{ Sistem::time_since($inbox->created_at) }}
			</td>
			<td class="text-right">
				<a class="btn btn-sm btn-danger btn-editable" onclick="event.preventDefault(); document.getElementById('delete').submit();">
				<i class="fa fa-trash"></i> </a>
			<form id="delete" action="{{ url('appweb/inbox/'.$inbox->id) }}" method="post" style="display: none;">
				@method('DELETE')
				@csrf
			</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
	<script>
		$(document).ready(function() {
			var table = $('#inboxall');

			table.dataTable({
			"language": {
                
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            "bStateSave": false, 
            "pagingType": "bootstrap_extended",

            "lengthMenu": [
                [10, 20, 50, -1],
                [10, 20, 50, "All"] 
            ],
            "pageLength": 10,
            "columnDefs": [{  
               'orderable': true,
               'targets': [0]
            }, {
                "searchable": true,
				"targets": [0]
            }],
            
        });   
    });
	</script>
