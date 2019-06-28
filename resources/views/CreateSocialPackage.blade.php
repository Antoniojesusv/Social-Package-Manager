@extends('layout.FormBase')

@section('pageHeader', 'Create new Social Package')
@section('title', 'Create')

@section('title', 'Create')

@section('action')
    action="/SocialPackage"
@endsection

@isset($name)
    @section('nameValue')
        value="{{$name}}"
    @endsection
@endisset

@isset($description)
    @section('descriptionValue')
        value="{{$description}}"
    @endsection
@endisset

@isset($startDate)
    @section('startDateValue')
        value="{{$startDate}}"
    @endsection
@endisset

@isset($endDate)
    @section('endDateValue')
        value="{{$endDate}}"
    @endsection
@endisset

@isset($amount)
    @section('amountValue')
        value="{{$amount}}"
    @endsection
@endisset

@section('buttonName', 'Create')
