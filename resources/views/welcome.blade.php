@extends('layouts.main')
@section('content')
    @if(isset($happy['last_name']))
        {{ $happy['location'] }}
    @else
        no last name set
    @endif

    @foreach($happy as $item)
        <li>{{{$item}}}</li>
    @endforeach

@stop
