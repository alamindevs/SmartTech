 <!-- Page-Title -->
 <div class="row">
 	<div class="col-sm-12">
 		<div class="page-title-box">
 			<div class="float-right">
 				<ol class="breadcrumb">	
 					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
 					{{$slot}}
 				</ol>
 			</div>
 			<h4 class="page-title">Dashboard</h4>
 		</div>
 	</div>
 	<!--end col-->
 </div>
 <!--end row-->
    <!-- end page title end breadcrumb -->