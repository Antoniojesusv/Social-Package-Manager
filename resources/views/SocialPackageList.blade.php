@extends('layout.DashboardBase')

@section('title', 'Social Packages')

@section('pageHeader', 'Social Package List')
@section('buttonSection')
  <a href="/new">
    <button type="button" class="btn btn-success">
      <i class="material-icons" style="vertical-align: middle;">add_circle</i> New Social Package
    </button>
  </a>
@endsection

@section('content')
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($socialPackagesCollection as $socialPackage)
          <tr>
            <td>{{ $socialPackage->id()}}</td>
            <td>{{ $socialPackage->name()}}</td>
            <td>{{ $socialPackage->description()}}</td>
            <td>
                <div class="container">
                  <div class="justify-content-start row">
                    <div class="btn-group mr-2" role="group">
                      <a href="/SocialPackage/{{$socialPackage->id()}}/edit">
                        <button type="button" class="btn btn-secondary">
                          <i class="material-icons" style="vertical-align: middle;">edit</i> Edit
                        </button>
                      </a>
                    </div>

                    <div class="btn-group mr-2" role="group">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $socialPackage->id() }}">
                        <i class="material-icons" style="vertical-align: middle;">delete</i> Delete
                      </button>
                    </div>

                    <div class="btn-group mr-2" role="group">
                        <a href="/SocialPackage/{{ $socialPackage->id()}}">
                            <button name="detailSocialPackage" class="btn btn-secondary">
                                <i class="material-icons" style="vertical-align: middle;">list</i>Detail
                            </button>
                        </a>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $socialPackage->id() }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      @component('layout.components.modals.delete-button-modal')
                        <form action="/SocialPackage/{{ $socialPackage->id() }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-success">Delete</button>
                        </form>
                      @endcomponent
                    </div>
                  </div>
                </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
