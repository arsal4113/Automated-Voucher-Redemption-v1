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
                      <div class="card-header"><h4> <b>Edit Service </b> </h4></div>
                      <br>
                  <form class="form-horizontal" action="{{ route('service.update',$service->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                        <div class="form-group">
                          <label class="control-label col-sm-4" >Service Name: * </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  placeholder="Enter name" name="name" value="{{$service->name}}" required>
                          </div>
                        </div>

                      <div class="form-group">
                          <label class="control-label col-sm-4" >Service Image: * </label>
                          <div class="col-md-6">
                          <img id="preview_company_logo" style="width : 60px; height:60px" src="{{ url($service->photos) }}"/>
                          <input type="file" name="photos" class="form-control" accept="image/*"   value="{{$service->photos}}">
                      </div>
                      </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2" >Service URL:</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" id="email" placeholder="Service URL" name="link1" value="{{$service->link1}}">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2" >Pdf URL:</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" id="email" placeholder="Pdf URL" name="link2" value="{{$service->link2}}">
                          </div>
                        </div>

                      <div class="form-group">
                          <label class="control-label col-sm-6" >Terms and Conditions URL:</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" id="email" placeholder="Terms and Conditions URL" name="link3" value="{{$service->link3}}">
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

