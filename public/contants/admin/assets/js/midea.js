$(function() {

	 $(document).on('click', '.select-image', function(e) {
	 	e.preventDefault();
	 	var url = $(this).attr('href');
	 	var path = $(this).data('src');
	 	var id = $(this).data('id');

	 	var imgType = $('.image-picker').data('image');
        var name = $('.image-picker').data('name');

        // singele type image select
        if(imgType == 'single'){
        	$('.image-picker').prev().children().html(
        		'<image src="' +url+ '"><input type="hidden" name="' +name+ '"value="' +path+ '"><button type="button" class="btn remove-image" data-image="single"><i class="fas fa-times"></i></button>'
        	);
        	$('#exampleModal').modal('hide');
        	successMessage('Image select Successful');
        }

	 });

	 $(document).on('click', '.remove-image', function() {
	 	var imgType = $(this).data('image');

	 	if(imgType == 'single'){
            $(this).parent().html('<i class="far fa-image"></i><input type="hidden" name="image_id" value="">');
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

})