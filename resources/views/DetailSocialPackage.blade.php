@extends('layout.DashboardBase')

@section('title', 'Detail')
@section('contentTitle', 'General Info')

@section('pageHeader', 'General Info')

@section('buttonSection')
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#subscriptionModal">
            <i class="material-icons" style="vertical-align: middle;">add_circle</i> Subscribe Employees
        </button>
        <a href="/SocialPackage">
            <button type="button" class="btn btn-danger">
                <i class="material-icons" style="vertical-align: middle;">arrow_back</i> Back
            </button>
        </a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
            @component('layout.components.modal')
                @slot('title')
                    Subscribe employees to social package
                @endslot
                @slot('formHeader')
                    <form action="/SocialPackage/{{ $detailSocialPackage->id() }}/subscribe" method="POST">
                @endslot
                @slot('body')
                        @csrf
                        <div class="form-group">
                            <label for="employees">Employees</label>
                            <select multiple class="form-control" name="employees[]" id="employees">
                                @foreach ($allEmployees as $employee)
                                    <option value="{{ $employee->id() }}">{{ $employee->name() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control" required>
                        </div>
                @endslot
                @slot('footer')
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                @endslot
                </form>
            @endcomponent
        </div>

        <form>
            <label>Name: {{ $detailSocialPackage->name() }}</label>
            <br>
            <label>Description: {{ $detailSocialPackage->description() }}</label>
            <br>
            <label>Start Date: {{ $detailSocialPackage->startDate() }}</label>
            <br>
            <label>End Date: {{ $detailSocialPackage->endDate() }}</label>
            <br>
            <label>Amount: {{ $detailSocialPackage->amount() }}</label>
        </form>
    </div>

    <br>

    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Employees Registered</h1>
        </div>

        <table class="table table-hover">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Amount</th>
            </tr>
            @foreach ($subscriptions as $subscriber)
            <tr>
                <td>{{ $subscriber->name() }}</td>
                <td>{{ $subscriber->startDate() }}</td> 
                <td>{{ $subscriber->endDate() }}</td>
                <td>{{ $subscriber->amount() }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
