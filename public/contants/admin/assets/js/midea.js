$(function() {
    // button on click model and this button info 
    $(document).on('click', '.image-picker', function() {
        window.modal = $('.bd-example-modal-xl');
        modal.modal('show');
       window.imgPicker = $(this);
    });

	$(document).on('click', '.select-image', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var path = $(this).data('src');
        var id = $(this).data('id');
        var imgType = imgPicker.data('image');
        var name = imgPicker.data('name');
        // singele type image select
        if(imgType == 'single'){
            imgPicker.prev().children().html(
                '<image src="' +url+ '"><input type="hidden" name="' +name+ '"value="' +path+ '"><button type="button" class="btn remove-image" data-image="single"><i class="fas fa-times"></i></button>'
            );
            $('#exampleModal').modal('hide');
            successMessage('Image select Successful');
        }
        // multiple type image select
        if(imgType == 'multiple'){
            $('.placeholder').remove();
            $('.image-list').append('<div class="image-holder"><image src="'+ url +'"><input type="hidden" name="'+ name +'" value="'+ id +'"><button type="button" class="btn remove-image" data-image="multiple"><i class="fas fa-times"></i></button></div>');
            return successMessage('Image successfully added!');
        }
     });

     // image remove image
    $(document).on('click', '.remove-image', function() {
         var imgType = $(this).data('image');
         if(imgType == 'single'){
            $(this).parent().html('<i class="far fa-image"></i><input type="hidden" name="image_id" value="">');
        }

        if(imgType == 'multiple' && $('.image-list .image-holder').length == 1){
            $('.image-list').html('<div class="image-holder placeholder"><i class="far fa-image"></i></div>');
        }else{
            $(this).parent().remove();
        }
        
    });

	 // show success message
    function successMessage(message) {
        $.toast({
            heading: 'Success',
            text: message,
            position: 'bottom-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3000, 
            stack: 6
        });
    };




});