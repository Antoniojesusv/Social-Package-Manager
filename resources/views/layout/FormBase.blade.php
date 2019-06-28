@extends('layout.DashboardBase')

@section('buttonSection')
  <a href="/SocialPackage">
    <button type="button" class="btn btn-danger">
      <i class="material-icons" style="vertical-align: middle;">arrow_back</i> Cancel
    </button>
  </a>
@endsection

@section('content')
    <form class="form-group" method="POST" @yield('action')>
        @yield('editMethod')
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" @yield('nameValue') class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Description (optional)</label>
            <input type="text" name="description" @yield('descriptionValue') class="form-control">
        </div>
        <div class="form-group">
            <label for="">Start date</label>
            <input type="date" name="startDate" @yield('startDateValue') class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">End date</label>
            <input type="date" name="endDate" @yield('endDateValue') class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Total amount</label>
            <input type="number" step="0.01" min="0" name="amount" @yield('amountValue') class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">@yield('buttonName')</button>
    </form>
@endsection
