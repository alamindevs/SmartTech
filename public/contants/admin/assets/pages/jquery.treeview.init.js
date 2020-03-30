/*
 Template: Metrica - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 File: Treeview
 */

 $(function () {
 	"use strict";

	//Check Box
	$('#jstree-checkbox').on("changed.jstree", function (e, data) {
		
			if(data.selected.length) {
				var url = data.node.a_attr.href;
				Pace.restart();
				Pace.track(function () {
					$.ajax({
						url: url,
						type: "GET",
						dataType: "HTML",
						success(data) {
							$('.category-form').html(data);
						},
						error(error) {
							Swal.fire(
								'Ops!',
								error.statusText,
								'error',
								);
						}
					});
				});
			}
		})
	.jstree({
		"checkbox" : {
			"keep_selected_style" : false
		},
		"plugins" : [ "checkbox"],
		'core' : {
			'data' : {   
				"state" : { "opened" : true },
				"url": window.origin + '/admin/categoriesTrees',
			}
		}
	}).jstree('open_all');
	


	// category show
	$('.collapse-all').on('click', (e) => {
		e.preventDefault();
		Pace.restart();
		$("#jstree-checkbox").jstree('open_all');
	});
	$('.expand-all').on('click', (e) => {
		e.preventDefault();
		Pace.restart();
		$("#jstree-checkbox").jstree('close_all');
	});
	

	// delete button
	$(document).on('click','.jstree-anchor', function(){
		if($(this).is('.jstree-anchor')){
			$(".delete-category").attr('disabled', false);
		}
		if($('.jstree-clicked').length == 0){
			$(".delete-category").attr('disabled', true);
		}

	});


});