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
																			<h2><b>Offers  </b></h2>
																		</div>
																		<div class="col-sm-6">
																			<a href="{{ route('offers.create')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New Offer </span></a>

																		</div>
																	</div>
																</div>

																<table class="table table-striped table-hover">

																	<thead>
																		<tr>


																			<th>ID</th>
																			<th>Offer Name</th>
                                      <th>Voucher Name</th>
																			<th>Product Name </th>
																			<th>Actions</th>

																		</tr>
																	</thead>
																	<tbody>
																	@foreach($offers as $key => $offer )
																		<tr>
																			<td> {{ $key }} </td>
																			<td> {{ $offer->offer_name }} </td>
																			<td> {{ $offer->vouchercode }} </td>
																			<td> {{ $offer->productitem }} </td>
																			<td>
																				<a href="{{ route('offers.edit',$offer->id) }}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
																				<a href="{{ route('offers.delete',$offer->id) }}" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
