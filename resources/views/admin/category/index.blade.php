@extends('layouts.admin') 

@section('pageTitle','Admin Deshboard')

@push('css')
    <link href="{{ asset('contants/admin') }}/assets/plugins/treeview/themes/default/style.css" rel="stylesheet">
    <link href="{{ asset('contants/admin') }}/assets/plugins/treeview/file-explore.css" rel="stylesheet">
@endpush

@section('content')

    @component('components.admin.breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
    @endcomponent
	
	 <!-- end page title end breadcrumb -->
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-2 header-title float-left">Categories Information</h4>
                    <a class="btn btn-info btn-sm float-right" href=""><i class="mdi mdi-plus-circle-outline"></i> Create Category</a>
                    <button class="delete-category btn btn-danger btn-sm float-right mr-2" data-url="{{ route('admin.category.destroy') }}" disabled=""><i class="mdi mdi-delete"></i> Delete</button>
                </div>
                    
                <div class="card-body">
                    <div class="row justify-content-center">
                    	<div class="col-4">
                    		<a href="#" class="collapse-all btn btn-success mb-2">open</a> |
                    		<a href="#" class="expand-all btn btn-danger mb-2">close</a>
                    		

                    		<div id="jstree-checkbox"></div>
                    	</div>
                        <div class="col-6 category-form">
                            <form action="{{ route('admin.category.store') }}" method="post" id="create-category" class="form-horizontal form-wizard-wrapper">
                                @csrf
                                <div class="form-group">
                                    <label for="example-email-input1" class="col-form-label">Category Name</label>
                                    <input name="name" class="form-control" type="text" placeholder="e.g. Eletronics">
                                </div>

                                <div class="form-group">
                                    <label for="example-email-input1" class="col-form-label">Parent Category</label>
                                    <select name="parent_id" class="form-control" id="category">
                                        <option value="">Parent Category</option>
                                        @foreach($categories as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-check-inline my-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" class="custom-control-input" id="customCheck" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                        <label class="custom-control-label" for="customCheck">Status</label>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-submit btn-primary waves-effect waves-light">Submit</button>
                                    <button type="reset" class="btn btn-info waves-effect waves-light">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection

@push('js')
<script src="{{ asset('contants/admin') }}/assets/js/category.js"></script>
<script src="{{ asset('contants/admin') }}/assets/js/csrf.js"></script>

<script src="{{ asset('contants/admin') }}/assets/plugins/treeview/jstree.min.js"></script>
<script src="{{ asset('contants/admin') }}/assets/plugins/treeview/file-explore.js"></script>
<script src="{{ asset('contants/admin') }}/assets/pages/jquery.treeview.init.js"></script>

<script>
	
</script>
@endpush