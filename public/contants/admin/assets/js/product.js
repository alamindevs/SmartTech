$(function(){

	 // Retrieve attribute values
    $(document).on('change', '.attributes', function () {
        var id = $(this).val();
        var url = route('attribute.values', id);
        var select = $(this);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "HTML",
            success(data) {
                select.parent().next().children('.select2-multiple').html(data);
            	Pace.restart();
            },
            error(error) {
                return errorStatusText(error);
            }
        });
    });

    // Retrieve global options
    $(document).on('click', '#btn-global', function () {
        var id = $('#option').val();
        var url = route('option.values', id);

        Pace.restart();
        Pace.track(function () {

            $.ajax({
                url: url,
                type: "GET",
                dataType: "HTML",
                success(data) {
                    $('.option').append(data);
                    $('.repeater-option').repeater({
                        repeaters: [{
                            // Specify the jQuery selector for this nested repeater
                            selector: '.repeater-custom-show-hide-inner'
                        }]
                    });
                    Pace.restart();
                },
                error(error) {
                    return errorStatusText(error);
                }
            });
        });
    });


    // select2 ajax product retrive releted product
	$(".select_product").select2({
		width: "100%",
		tags: false,
		multiple: true,
		tokenSeparators: [',', ' '],
		minimumInputLength: 2,
		minimumResultsForSearch: 10,
		ajax: {
			url: route('getProducts'),
			dataType: "json",
			type: "GET",
			data: function (params) {
				var queryParameters = {
					term: params.term
				}
				return queryParameters;
			},
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item.name,
							id: item.id
						}
					})
				};
			}
		}
	});


// Route making
    function route(route, id){
        var url = route.replace(/\./g, '/');
        return window.origin + '/admin/' + url + '/' + id;
    }

});