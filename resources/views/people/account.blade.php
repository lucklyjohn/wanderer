@extends('layouts.account')
@section('content')
    <div class="col-md-10 col-md-offset-1 content">
        @include('people.part.accountleft')
        @include('people.part.accountright')
    </div>
@endsection
@section('scripts')
    <link href="{{ asset('css/account.css') }}" rel="stylesheet">
@endsection