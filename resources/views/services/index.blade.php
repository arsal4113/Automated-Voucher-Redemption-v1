<style>
    .card-header {
        padding-bottom: 15px !important;
        background: #435d7d !important;
        color: #fff !important;
        padding: 10px 15px !important;
        min-width: 100% !important;
        border-radius: 3px 3px 0 0 !important;
    }
</style>
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="container-xl">
														<div class="table-responsive">
															<div class="table-wrapper">
																<div class="table-title">
																	<div class="row">
																		<div class="col-sm-6">
																			<h2><b>Services  </b></h2>
																		</div>
																		<div class="col-sm-6">
																			<a href="{{ route('service.create')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New Service </span></a>

																		</div>
																	</div>
																</div>

																<table class="table table-striped table-hover">

																	<thead>
																		<tr>


																			<th>ID</th>

																			<th>Service Name</th>
                                                                            <th>Service Image</th>
																			<th>Link1</th>
																			<th>Link2</th>
                                                                            <th>Link2</th>
																			<th>Actions</th>

																		</tr>
																	</thead>
																	<tbody>
																	@foreach($services as $service )
																		<tr>
																			<td>
																				{{ $service->id }}
																			</td>
																			<td>{{ $service->name }}</td>
                                                                            <td> <img id="preview_company_logo" style="width : 60px; height:60px" src="{{ url($service->photos) }}"/></td>
																			<td>{{ $service->link1 }}</td>
																			<td>{{ $service->link2 }}</td>
                                                                            <td>{{ $service->link3 }}</td>
																			<td>
																				<a href="{{ route('service.edit',$service->id) }}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
																				<a href="{{ route('service.delete',$service->id) }}" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
																			</td>
																		</tr>

																		@endforeach



																	</tbody>
																</table>

															</div>
														</div>
													</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('sweetalert::alert')
@endsection
