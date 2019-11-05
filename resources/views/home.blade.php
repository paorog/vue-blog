@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <create-post />
        </div>
        <div class="col-md-6">
            <all-posts />
        </div>
    </div>
</div>
@endsection
