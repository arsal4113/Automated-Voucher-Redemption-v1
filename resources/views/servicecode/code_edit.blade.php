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



<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                      <div class="card-header"><h4> <b>Edit Service Code </b> </h4></div>
                      <br>

                  <form class="form-horizontal" action="{{ route('servicecode.update',$servicecodes->id) }}" method="post">
                  @csrf
                        <div class="form-group">
                          <label class="control-label col-sm-4" >Service Code Name:</label>
                          <div class="col-md-6">
                <input type="text" class="form-control"  placeholder="Enter name" name="service_code"
                 value="{{$servicecodes->service_code}}" required>
                          </div>
                        </div>

                            <div class="form-group">
                            <label class="control-label col-sm-4">Choose Voucher: </label>
                            <div class="col-md-6">
                          <select name="voucher_id" class="form-control">
                          @foreach($vouchers as $voucher)
                            <option value="{{ $voucher->id }}"> {{ $voucher->VoucherCode }} </option>
                           @endforeach
                          </select>
                             </div>
                            </div>

                            <div class="form-group">
                            <label class="control-label col-sm-4">Choose Service: </label>
                            <div class="col-md-6">
                          <select name="service_id" class="form-control">
                          @foreach($services as $service)
                            <option value="{{ $service->id }}"> {{ $service->name }} </option>
                           @endforeach
                          </select>
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

