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
				<button class="btn-delete btn btn-danger btn-sm float-right mr-2" data-url="" disabled><i class="mdi mdi-delete"></i> Delete</button>
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
<script src="{{ asset('contants/admin') }}/assets/plugins/dropzone/dropzone.js"></script>

<script src="{{ asset('contants/admin') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

{{-- button use  --}}
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/jszip.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/buttons.colVis.min.js"></script>
    
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('contants/admin') }}/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script>
// "myAwesomeDropzone" is the camelized version of the HTML element's ID
Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  init() {
  	this.on("success", function(file) {
  		console.log('data');
  		// $('#datatable').DataTable().ajax.reload();
  	});
  },
  
  
};



$("#datatable").DataTable({
       
    
    })
</script>
@endpush