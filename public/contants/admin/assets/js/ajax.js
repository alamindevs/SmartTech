$(function(){
	/*
	*
	*common javaScript strat
	* 
	*/

	// check all checkbox
    $(document).on('click', '.check-all', function(){
        $('.delete-checkbox').not(this).prop('checked', this.checked);
    });

    $(document).on('click','.delete-checkbox, .check-all', function(){
    	if($(this).is(":checked")){
    		$(".btn-delete").attr('disabled', false);
    	}

        // Uncheck checkbox
        if($('.delete-checkbox:checked').length < $('.delete-checkbox').length){
        	$('.check-all').prop("checked", false);
        }else{
        	$('.check-all').prop("checked", true);
        }

        //common delete Button disable if check length is 0
        if($('.delete-checkbox:checked').length == 0){
        	$(".btn-delete").attr('disabled', true);
        }
    });

    /*
    *
    *end common javaScript 
    * 
    */

     //  create ajax
     $(document).on('submit','#create-form',function(event) {
     	event.preventDefault();
     	var formdata = new FormData($(this)[0]);

     		$.ajax({
     			url:this.action,
     			type:this.method,
     			data:formdata,
     			dataType:'JSON',
     			contentType: false,
     			processData: false,
     			cache: false,
     			beforeSend:function() {
     				$('.btn-submit').attr("disabled", true).html("<span class='spinner-border spinner-border-sm'></span> Loadding...");
     				Pace.restart()
     			},
     			 success(data) {
     			 	if(data.success) {
     			 		$("#create-form")[0].reset();
     			 		$('.invalid-feedback').remove();
     			 		return successMessage(data.success);
     			 	}else{
     			 		return errorMessage(data.error);
     			 	}
     			 },
     			 error(error) {
     			 	if(error.status == 422) {
     			 		var errors = error.responseJSON.errors;
     			 		var errorField = Object.keys(errors)[0];
     			 		var inputField = $('[name="'+ errorField +'"]');
     			 		var errorMessage = errors[errorField][0];

     			  		 // Show error message
     			  		 if(inputField.next('.invalid-feedback').length == 0){
     			  		 	inputField.focus().after('<div class="invalid-feedback"> <strong>'+ errorMessage +'</strong> </div>');
     			  		 }else{
     			  		 	inputField.focus();
     			  		 }
     			  		 // Remove error message
     			  		 inputField.on('keydown, change', function() {
     			  		 	inputField.next('.invalid-feedback').remove();
     			  		 });
     			  		}else{
     			  			return errorStatusText(error);
     			  		}
     			  	},
     			  	complete:function() {
     			  		$('.btn-submit').attr("disabled", false).html("Submit");
     			  	}
     		});
     });

     // update ajax
     $(document).on('submit', '#update-form', function (event) {
     	event.preventDefault();
     	var formdata = new FormData($(this)[0]);

     	$.ajax({
     		url: this.action,
            type: this.method,
            data: formdata,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend:function() {
                $('.btn-submit').attr("disabled", true).html("<span class='spinner-border spinner-border-sm'></span> Loadding...");
            	Pace.restart()
            },
            success(data) {
            	if(data.success) {
            		$('.invalid-feedback').remove();
            		return successMessage(data.success);
            	}else{
            		return errorMessage(data.error);
            	}
            },
            error(error) {
                if(error.status == 422) {
                    var errors = error.responseJSON.errors;
                    var errorField = Object.keys(errors)[0];
                    var inputField = $('[name="'+ errorField +'"]');
                    var errorMessage = errors[errorField][0];

                    // Show error message
                    if(inputField.next('.invalid-feedback').length == 0){
                        inputField.focus().after('<div class="invalid-feedback"> <strong>'+ errorMessage +'</strong> </div>');
                    }else{
                        inputField.focus();
                    };

                    // Remove error message
                    inputField.on('keydown, change', function() {
                        inputField.next('.invalid-feedback').remove();
                    });
                }else{
                    return errorStatusText(error);
                }
            },
            complete:function() {
                $('.btn-submit').attr("disabled", false).html("Update");
            }
     	});
     });


    //ajax Delete multiple data
    $(document).on('click','.btn-delete',function(){
    	var id = [];
    	var url = $(this).data('url');

    	$('.delete-checkbox:checked').each(function(){
    		id.push($(this).val());
    	});

    	id.push($(this).data('id'))

    	Swal.fire({
    		title: 'Are you sure?',
    		text: "You won't be able to revert this!",
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#f1646c',
    		cancelButtonColor: '#4d79f6',
    		confirmButtonText: 'Yes, delete it!'
    	}).then((result) =>{
    		if(result.value){
    			Pace.restart();
    			Pace.track(function () {
    				$.ajax({
    					url:url,
    					type:'DELETE',
    					dataType:'json',
    					data:{id:id},
    					beforeSend:function(){
    						Pace.restart()
    					},
    					success(data){
    						if(data.success){
    							$('#datatable').DataTable().ajax.reload();
    							$(".btn-delete").attr('disabled', true);
    							$('.check-all').prop("checked", false);
    							return successMessage(data.success);
    						}else{
    							return errorMessage(data.error);
    						}
    					},
    					error(error){
    						return errorStatusText(error);
    					},
    				});
    			});
    		}
    	});
    });

    // switch button ajax active or unactive

    $(document).on('click', '.custom-switch .custom-control-input', function(event){
    	var action = $(this).data('url');
    	$.ajax({
    		url:action,
    		type:'put',
    		dataType:'JSON',
    		cache: false,
    		beforeSend:function(){
    			Pace.restart()
    		},
    		success(data) {
                $('#datatable').DataTable().ajax.reload();
                return successMessage(data.success);
            },
            error(error) {
                return errorStatusText(error);
            },
    	});

    });


});