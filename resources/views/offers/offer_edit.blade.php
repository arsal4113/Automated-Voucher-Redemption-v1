@extends('layouts.app')

@section('content')



<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                      <div class="card-header"><h4> <b>Edit Offer </b> </h4></div>

                      <br>

                  <form class="form-horizontal" action="{{ route('offers.update',$offers->id) }}" method="post">
                  @csrf
                        <div class="form-group">
                          <label class="control-label col-sm-4">Offer Name:</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="{{ $offers->offer_name }}" name="offer_name" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-8">Choose No of Services: (between 3 & 9)</label>
                          <div class="col-md-6">
                            <input type="number" class="form-control" name="service_number" min="3" max="9" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

