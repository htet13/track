@extends('layouts.home.app')

@section('content')
<main>
  <div class="container">

    <section class="section register min-vh-80 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3 bg-main text-main">
               <div class="py-3 mx-3"> 
                  <div class="fs-4"><a href="{{route('admin.logistics')}}" style="background-color: #031F63; color: #E1E889">Logistics System</a></div>
                </div>
            </div>

            <div class="card mb-3 bg-main text-main">
               <div class="py-3" style="margin: 0 41px"> 
                  <div class="fs-4"><a href="{{ route('hr.employee.index', 'new') }}" style="background-color: #031F63; color: #E1E889">HR System</a></div>
                </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </div>

</main><!-- End #main -->
@endsection
