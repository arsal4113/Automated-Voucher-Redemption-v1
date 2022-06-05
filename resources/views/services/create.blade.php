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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        var maxField = 9; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="form-group">'+
            '<label class="control-label col-sm-4" for="email">Service Name: * </label>'+
            '<div class="col-md-6">'+
            '<input type="text" class="form-control"  placeholder="Enter name" name="name[]" required value="">'+
            '</div>'+
            '</div>'; //New input field html
        var x = 3; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> <h4> <b>Add New Service </b> </h4></div>
                    <br>
                    <form class="form-horizontal" action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="field_wrapper">
                            <div class="form-group">
                                <label class="control-label col-sm-4" >Service Name : * </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control "  placeholder="Enter name" name="name[]" required value="">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6">Service Image *</label>
                            <div class="control-label col-sm-6" >
                                <input type="file" name="photos" class="form-control" accept="image/*" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Service URL:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" placeholder="Service URL" name="link1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Pdf URL:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" placeholder="Pdf URL" name="link2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >Terms and Conditions URL:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" placeholder="Terms and Conditions URL" name="link3">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    @include('sweetalert::alert')
@endsection

