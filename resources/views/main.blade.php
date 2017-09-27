@extends('layouts.common')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="descriptor">
        <span class="descriptor-title">
            @{{ descriptor.title }}
        </span>
        <span class="descriptor-content">
            @{{ descriptor.content }}
        </span>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/javascript/main.js')}}"></script>
@endsection

<script type="text/javascript">
console.log(111111111);

	var test = document.getElementById('testViewport');

    console.log(test);
</script>