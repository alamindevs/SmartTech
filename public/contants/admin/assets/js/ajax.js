$(function(){


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

        // Button disable if check length is 0
        if($('.delete-checkbox:checked').length == 0){
        	$(".btn-delete").attr('disabled', true);
        }
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



});