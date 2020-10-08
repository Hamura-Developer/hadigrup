<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    
    function viewmessage($id) {
        var content = $('.inbox-content');
        var loading = $('.inbox-loading');
        var listListing = '';

        var url = "{{ url('appweb/inbox/viewinbox') }}";

        loading.show();
        content.html('');
        
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: "message_id="+$id,
            success: function(res) 
            {
                loading.hide();
                content.html(res);
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                // toggleButton(el);
            },
            async: false
        });
    };
    $(document).ready(function(){

        var content = $('.inbox-content');
        var loading = $('.inbox-loading');
        var listListing = '';

        var loadCompose = function () {
            if( typeof ($.fn.slideToggle) === 'undefined'){ return; }
                console.log('Success');
              $('.compose').slideToggle();      
        }
    
        var loadReply = function (el) {
            var messageid = $(el).attr("data-messageid");
            var url = "{{ url('appweb/inbox/balasinbox') }}";

            
            loading.show();
            content.html('');
            toggleButton(el);
            
            $.ajax({
                type: "GET",
                cache: false,
                url: url,
                data: {'messageid': messageid,'_token':'{{ csrf_token() }}'},
                dataType: "html",
                success: function(res) 
                {
                    toggleButton(el);

                    $('.inbox-nav > li.active').removeClass('active');
                    $('.inbox-header > h1').text('Reply');

                    loading.hide();
                    content.html(res);
                    $('[name="message"]').val($('#reply_email_content_body').html());

                },
                error: function(xhr, ajaxOptions, thrownError)
                {
                    toggleButton(el);
                },
                async: false
            });
        }

        var toggleButton = function(el) {
            if (typeof el == 'undefined') {
                return;
            }
            if (el.attr("disabled")) {
                el.attr("disabled", false);
            } else {
                el.attr("disabled", true);
            }
        }
        
        $('#compose, .compose-close').on('click', function () {
            loadCompose($(this));
        });
        
        $('.x_content').on('click', '.reply-btn', function () {
            loadReply($(this));
        });
        
    });
    
    var url = "{{ url('/ckfinder/ckfinder.html') }}";
	CKEDITOR.replace('editor-ckeditor',{
		filebrowserBrowseUrl: url,
		filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        height:200
	});
</script> 
