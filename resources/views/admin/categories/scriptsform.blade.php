<script>
	$(document).ready(function() { 	
		var form = $('#formkategori');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);
		
		form.validate({
			doNotHideMessage: true, 
			errorElement: 'span', 
			errorClass: 'help-block help-block-error', 
			focusInvalid: false, 
			rules:{
				nama: {
					required: true,
				},
				status: {
					required: true,
				}
			},
			
			messages:{
				nama: {
					required: 'Nama Kategori harus diisi',
				},
				status: {
					required: 'Parent Kategori harus diisi',
				}
			},
			invalidHandler: function (event, validator) {    
					success.hide();
					error.show();
					Server.scrollTo(error, -200);
				},

			highlight: function (element) { 
				$(element)
					.closest('.form-group').removeClass('has-success').addClass('has-error'); 
			},

			unhighlight: function (element) { 
				$(element)
					.closest('.form-group').removeClass('has-error'); 
			},
			
			success: function (label) {
				label
					.addClass('valid') 
					.closest('.form-group').removeClass('has-error').addClass('has-success'); 
			},
			
			submitHandler: function (form) {
				success.show();
				error.hide();
				form.submit(); 
			},
		});
	});
</script>