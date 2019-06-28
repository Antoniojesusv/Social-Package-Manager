@extends('layout.AppBase')

@section('generalWrapper')
      <div class="container-fluid">
        <div class="row">
          @include('layout.partials.sidebar')

          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 class="h2">@yield('pageHeader')</h1>
              @yield('buttonSection')
            </section>
            <section>
                @isset($errorMessage)
                    <div class="alert alert-warning alert-dismissible">
                        {{ $errorMessage }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            &times;
                        </button>
                    </div>
                @endisset
              @yield('content')
            </section>

            <div class="align-items-end">

            <div id="snackbar">{{ session('toast')['message'] }}</div>
            </div>
          </main>
        </div>
      </div>
@endsection
