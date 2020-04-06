@extends('layouts.admin') 

@section('pageTitle','Admin Deshboard')

@section('content')

@component('components.admin.breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endcomponent
	 <!-- end page title end breadcrumb -->
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-2 header-title float-left">Update Features Sets</h4>
                    <a class="btn btn-info btn-sm float-right" href="{{ route('admin.attribute-set.index') }}"><i class="mdi mdi-arrow-left-thick"></i> Back</a>
                </div>
                    
                <form action="{{ route('admin.attribute-set.update', $attributeSet->id) }}" method="post" id="update-form" class="form-horizontal form-wizard-wrapper">
                   @csrf
                   @method('put')
                        
                    <div class="card-body">
                        <div class="form-group">
                            <label for="example-email-input1" class="col-form-label">Name</label>
                            <input name="name" class="form-control" type="text" value="{{ $attributeSet->name }}">
                        </div>

                        <div class="form-check-inline my-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="status" class="custom-control-input" id="customCheck" {{ $attributeSet->status == 1 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customCheck">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-submit btn-primary waves-effect waves-light">Update</button>
                        <a href="{{ route('admin.attribute-set.index') }}" class="btn btn-info waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@push('js')
	<script src="{{ asset('contants/admin') }}/assets/js/csrf.js"></script>
	<script src="{{ asset('contants/admin') }}/assets/js/ajax.js"></script>
@endpush