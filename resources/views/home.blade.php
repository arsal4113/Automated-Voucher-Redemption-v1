@extends('layouts.app')

@section('content')
    <div style="background:black">
        <h1 class="text-center text-white"  > Your {{ auth()->user()->email }}</h1>
    </div>

    <home></home>
@endsection
