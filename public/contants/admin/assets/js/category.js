/*
1. Category insert Ajax;
2.  

 */
$(function(){

	// create ajax
	$(document).on('submit','#create-category',function(event){
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:this.action,
			type:this.method,
			data:formData,
			dataType: "JSON",
			contentType: false,
			processData: false,
			cache: false,
			beforeSend:function() {
				$('.btn-submit').attr('disabled',true).html("<span class='spinner-border spinner-border-sm'></span> Loadding...");
				Pace.restart()
			},
			success(data) {
				$('#jstree-checkbox').jstree("refresh");
				$('#create-category')[0].reset();
				successMessage(data.success);
				return getCategory();
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
                    inputField.on('keydown', function() {
                        inputField.next('.invalid-feedback').remove();
                    });
                }else{
                     return errorStatusText(error);
                }
			},
			complete:function() {
				$('.btn-submit').attr('disabled',false).html("Submit");
			},
		});

	});

	//update category
	$(document).on('submit','#update-category',function(event){
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
            },
            success(data){
            	if(data.success){
            		$('#jstree-checkbox').jstree("refresh");
            	}else{
            		return errorMessage(data.error);
            	}
            },
            error(error){
            	
            	if(error.status == 422){
            		var errors = error.responseJSON.errors;
            		var errorField = Object.keys(errors)[0];
            		var inputField = $('[name="'+ errorField +'"]');
            		var errorMessage = errors[errorField][0];

            		if(inputField.next('.invalid-feedback').length == 0){
                        inputField.focus().after('<div class="invalid-feedback"> <strong>'+ errorMessage +'</strong> </div>');
                    }else{
                        inputField.focus();
                    }
                    // Remove error message
                    inputField.on('keydown', function() {
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
// category delete 
	$(document).on('click','.delete-category', function(event){
		event.preventDefault();
        // console.log($('#jstree-checkbox').jstree(true).get_selected());
		var id = [];
		var url = $(this).data('url');

		$('.jstree-clicked').each(function() {
            id.push($(this).parent().attr('id'));
        });
       
    	 id.push($(this).attr('id'));

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f1646c',
            cancelButtonColor: '#4d79f6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        	console.log(id);
        	Pace.restart();
        	Pace.track(function () {
        		$.ajax({
        			url: url,
        			data: {id:id},
        			type: "DELETE",
        			dataType: "JSON",
        			success(data) {
        				if(data.success) {
        					location.reload();
        				}else{
        					return errorMessage(data.error);
        				}
        			},
        			error(error) {
        				return errorStatusText(error);
        			}
        		});
        	});
        })
        
	});

// fonm category ajax
function getCategory() {
	$.ajax({
		url: route('categoryAjax'),
		type:'GET',
		dataType:'HTML',
		success(data) {
			$('#category').html(data);
		},
		error(error) {
			return errorStatusText(error);
		}

	});
}

	 
	// route makeing
	function route(route){
		var url = route.replace(/\./g, '/');
		return window.origin + '/admin/' + url;
	}
});