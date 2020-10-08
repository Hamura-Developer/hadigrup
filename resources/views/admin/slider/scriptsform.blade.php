<script>
	$(document).ready(function() { 
				 
		var form = $('#formslider');
		var error = $('.alert-danger', form);
		var success = $('.alert-success', form);
		
		form.validate({
			doNotHideMessage: true, 
			errorElement: 'span', 
			errorClass: 'help-block help-block-error', 
			focusInvalid: false, 
			rules:{
				name: {
					required: true,
				},
				status: {
					required: true,
				},
			},
			
			messages:{
				name: {
					required: 'Nama harus diisi',
				},
				status: {
					required: 'Status belum dipilih',
				},
			},
			
			errorPlacement: function (error, element) { 
				if (element.attr("data-error-container")) { 
					error.appendTo(element.attr("data-error-container"));
				}else {
					error.insertAfter(element); 
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
		$('.select2me',form).change(function () {
			form.validate().element($(this)); 
		});
	});
</script>