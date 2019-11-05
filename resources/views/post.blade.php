@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <view-post :post="{{ $post }}" :user="{{ $user }}" />
        </div>
    </div>
</div>
@endsection
