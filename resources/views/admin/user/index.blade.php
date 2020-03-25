@extends('layouts.admin') 
@push('css')
    <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('contants/admin') }}/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <!-- Page-Title -->
    @component('components.admin.breadcrumb')
    <li class="breadcrumb-item active">Users</li>
    @endcomponent
    
    <!-- end page title end breadcrumb -->
    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mt-2 header-title float-left">Users Information</h4>
                                <a class="btn btn-info btn-sm float-right" href=""><i class="mdi mdi-plus-circle-outline"></i> Create User</a>
                                <button class="btn-delete btn btn-danger btn-sm float-right mr-2" data-url="" disabled><i class="mdi mdi-delete"></i> Delete</button>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Age</th>
                                            <th>status</th>
                                            <th>phone</th>
                                            <th>subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>alamin</td>
                                            <td>alamin@gmail.com</td>
                                            <td>almain</td>
                                            <td>61</td>
                                            <td>active</td>
                                            <td>01876619765</td>
                                            <td>projrammer</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

@endsection
@push('js')
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
        // lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis" ,"print",]
    }).buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)"), $("#row_callback").DataTable({
        createdRow: function(t, a, e) {
            15e4 < 1 * a[5].replace(/[\$,]/g, "") && $("td", t).eq(5).addClass("highlight")
        }
    })
    </script>
@endpush