@extends('layouts.common')
@section('content')
<div class="col-md-10 col-md-offset-1 content">
@include('people.part.zoneleft')
@include('people.part.zoneright')
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/javascript/person/zonepage.js')}}"></script>
@endsection