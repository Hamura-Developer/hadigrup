<script>
	$(document).ready(function() { 
				 
		var form = $('#formuser');
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
				email: {
					required: true,
					email: true
					
				},
				password: {
					minlength: 8,
				},
				confirm_password: {
					equalTo : "#password", 
				},
				role: {
					required : true, 
				},
				
			},
			
			messages:{
				password:{
					required: "Password Harus Di Isi",
					minlength: 'Password minimal 8 karakter'
				},
				confirm_password: {
					required: "Konfirmasi Password Harus Di Isi",
					equalTo : "Konfirmasi Password harus sama dengan Password"
					
				},
				email: {
					required: 'Email harus diisi',
				},
				name: {
					required: 'Nama harus diisi',
				},
				role: {
					required: 'Role belum di pilih',
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
		
		$('.select2me', form).change(function () {
			form.validate().element($(this)); 
		});
	});
</script>