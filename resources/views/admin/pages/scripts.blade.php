<script>
	$(document).ready(function() { 
		var grid = new Datatable();

		grid.init({
			src: $("#listpages"),
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
				  	"url": "{{ url('appweb/pages') }}",
					"data": {
						'_token': '{{ csrf_token() }}'
					}
				 },
				"order": [
					[1, "asc"]
				] 
			}  
		});
	});
	function hapusid(id) {
		if(confirm('Apakah anda yakin mau menghapus data ini?')){
			$.ajax({
				type: 'POST',
				url: "{{ url('appweb/pages') }}",
				data:{
					'id':id,
					'_method':'DELETE',
					'_token': '{{ csrf_token() }}'
				},
				success: function (data) {
					console.log(data);
					swal("Success!", "Data berhasil di hapus!", "success");
					window.location.reload('{{ url('appweb/pages') }}');
				},
					error:function(data){
					swal("Oops...", "Something went wrong :(", "error");
				}
			});
		}
	};
</script>