$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function successMessage(message) {
        $.toast({
            heading: 'Success',
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3000, 
            stack: 6
        });
    };

    // show error message
    function errorMessage(message) {
        $.toast({
            heading: 'Error',
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3000, 
            stack: 6
        });
    };

	function errorStatusText(error) {
        $.toast({
            heading: error.status,
            text: error.statusText,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3000, 
            stack: 6
        });
    }

    