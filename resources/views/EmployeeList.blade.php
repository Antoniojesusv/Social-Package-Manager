@extends('layout.DashboardBase')

@section('title', 'Employees')

@section('pageHeader', 'Employee List')
@section('buttonSection')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importFileModal">
        <i class="material-icons" style="vertical-align: middle;">add_circle</i> Import employees
    </button>

    <div class="modal fade" id="importFileModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <form action="/Employee" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" accept=".xls, .xlsx" class="custom-file-input" id="importFile" name="importFile">
                                <label class="custom-file-label" id="importFileLabel">Choose file to import employees</label>

                                <script src=" {{ asset('js/EmployeeListView/EmployeeListView.js') }} "></script>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id='cancelButton' type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($listOfEmployees as $employee)
                <tr>
                    <td> {{ $employee->id() }} </td>
                    <td> {{ $employee->name() }} </td>
                    <td> {{ $employee->email() }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
