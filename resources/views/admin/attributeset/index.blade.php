@extends('layouts.admin') 
@push('css')
    <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
	
	<style>
		.dt-buttons{
			margin-right: 160px !important;
		}
		.dataTables_length{
			display:inline-block !important;
			margin-right: 112px !important;
		}
		.dataTables_filter{
			display: inline-block !important;
		}
	</style>
@endpush

@section('pageTitle','Admin Deshboard')

@section('content')
@component('components.admin.breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endcomponent

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-2 float-left">Brands Information</h4>
                    <a class="btn btn-info btn-sm float-right" href="{{ route('admin.attribute-set.create') }}"><i class="mdi mdi-plus-circle-outline"></i> Create Brand</a>
                    <button class="btn-delete btn btn-danger btn-sm float-right mr-2" data-url="{{ route('admin.attribute-set.destroy') }}" disabled=""><i class="mdi mdi-delete"></i> Delete</button>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>
                                    <div class="custom-control custom-checkbox">
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
    <!-- end row -->


@endsection

@push('js')
	<script src="{{ asset('contants/admin') }}/assets/js/csrf.js"></script>
	<script src="{{ asset('contants/admin') }}/assets/js/ajax.js"></script>

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
    	$("#datatable").DataTable({
    		serverSide: true,
    		ajax: "{{ route('admin.attribute-set.dataTable') }}",
    		columns: [
    		{ name: 'name' },
    		{ name: 'status', orderable: false },
    		{ name: 'action', orderable: false, searchable: false }
    		],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: ["excel", "pdf", "colvis" ,"print",],
        dom: 'Blfrtip',
    })
</script>
@endpush