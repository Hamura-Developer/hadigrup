<script type="text/javascript" >
	$(document).ready(function() { 
		var grid = new Datatable();

		grid.init({
			src: $("#liststatistik"),
			onSuccess: function (grid) {
				
			},
			onError: function (grid) {
				  
			},
			loadingMessage: 'Loading...',
			dataTable: {
				"lengthMenu": [
					[10, 20, 50, 100, 150],
					[10, 20, 50, 100, 150]  
				],
				"pageLength": 10, 
				"ajax": {
				  	"url": "{{ url('appweb/visitor') }}",
				  	"data": {
					  "_token":"{{ csrf_token() }}"
					}
				 },
				"order": [
					[1, "asc"]
				] 
			}  
		});
	});
</script>
