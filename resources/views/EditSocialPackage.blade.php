@extends('layout.FormBase')

@section('pageHeader', 'Edit Social Package')
@section('title', 'Edit')

@section('title', 'Edit')

@section('action')
    action="/SocialPackage/{{$socialPackage->id()}}"
@endsection

@section('editMethod')
    @method('PUT')
@endsection

@section('nameValue')
    value="{{$socialPackage->name()}}"
@endsection

@section('descriptionValue')
    value="{{$socialPackage->description()}}"
@endsection

@section('startDateValue')
    value="{{$socialPackage->startDate()}}"
@endsection

@section('endDateValue')
    value="{{$socialPackage->endDate()}}"
@endsection

@section('amountValue')
    value="{{$socialPackage->amount()}}"
@endsection

@section('buttonName', 'Save changes')
