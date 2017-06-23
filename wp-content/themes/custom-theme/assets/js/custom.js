$(document).ready(function(e) {

    $.validate({
         form: '#form-register',
         errorMessagePosition: 'inline',
         validateOnBlur: true,
         onSuccess: function(data) {
            $.ajax({    
                type: 'POST',
                url: wpAjax.ajaxUrl,
                data: $(data).serialize() + '&action=register_user',
                success: function(res) {
                    // clear form input
                    $('#form-register').each(function() {
                        this.reset();
                    });
                    location.href = res.redirect;
                },
                error: function(xhr, opt, err){
                },
                complete: function(res){
                }
            });

            return false;
         }
    });

    $('#logout').click(function() {
            $.ajax({    
                type: 'GET',
                url: wpAjax.ajaxUrl,
                data: '&action=destroy_session',
                success: function(res){
                    location.href = res.redirect;
                },
                error: function(err){
                    console.log(err);
                },
                complete: function(){
                }
            });

            return false;

    });

    
});
