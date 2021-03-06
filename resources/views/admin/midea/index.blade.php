@extends('layouts.admin') 

@section('pageTitle','Admin Deshboard')

@push('css')
    <link href="{{ asset('contants/admin') }}/assets/plugins/dropzone/dropzone.css" rel="stylesheet">

	 <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@component('components.admin.breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endcomponent

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="mt-2 header-title float-left">Media</h4>
				<button class="btn-delete btn btn-danger btn-sm float-right mr-2" data-url="{{ route('admin.midea.destroy') }}" disabled><i class="mdi mdi-delete"></i> Delete</button>
			</div>

			<div class="card-body">
				<form action="{{ route('admin.midea.store') }}" method="post" class="dropzone mb-3" enctype="multipart/form-data" id="myDropzone">
					@csrf
					<div class="fallback">
						<input name="file" type="file" multiple />
					</div>
				</form>

				<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Thumbnail</th>
							<th>Filename</th>
							<th>Date/Time</th>
							<th>
								<div class="custom-control custom-checkbox d-inline">
									<input type="checkbox" class="check-all custom-control-input" id="horizontalCheckbox">
									<label class="custom-control-label" for="horizontalCheckbox">Action</label>
								</div>
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<!-- end col -->
</div>





@endsection

@push('js')
<script src="{{ asset('contants/admin') }}/assets/js/csrf.js"></script>
<script src="{{ asset('contants/admin') }}/assets/js/ajax.js"></script>

<script src="{{ asset('contants/admin') }}/assets/plugins/dropzone/dropzone.js"></script>

<script src="{{ asset('contants/admin') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{ asset('contants/admin') }}/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script>
// "myDropzone" is the camelized version of the HTML element's ID
Dropzone.options.myDropzone = {
	paramName: "file",
	acceptedFiles:".jpeg,.jpg,.png,.gif",
	maxFilesize: 2,
	init() {
		this.on("success", function(file) {
			$('#datatable').DataTable().ajax.reload();
		});
	}
};

$("#datatable").DataTable({
	serverSide: true,
	ajax: "{{ route('admin.midea.dataTable') }}",
	columns: [
	{ name: 'path' },
	{ name: 'name' },
	{ name: 'created_at', orderable: false},
	{ name: 'action', orderable: false, searchable: false},
	
	],

})
</script>
@endpush