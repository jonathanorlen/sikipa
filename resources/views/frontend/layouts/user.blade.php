<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontend.includes.styles')
</head>

<body>
  @include('frontend.includes.header')
  
  @yield('hero')

  <main id="main">
     <section id="breadcrumbs" class="breadcrumbs">
          <div class="container">
        
            <ol>
              <li><a href="index.html">Dashboard</a></li>
              {{-- <li>Inner Page</li> --}}
            </ol>
            <h2>User Profile</h2>
        
          </div>
        </section>
          <section class="inner-page">
               <div class="container">
               <p>
               <div class="row justify-content-between">
                    <div class="col-md-3 fixed">
                    <div class="border-end bg-white" id="sidebar-wrapper">
                         {{-- <div class="sidebar-heading border-bottom bg-light">Menud</div> --}}
                         <div class="list-group list-group-flush">
                         <a class="list-group-item list-group-item-action list-group-item-light p-3 {{Request::is('user/dashboard')?'active':''}}" href="{{route("user.dashboard")}}">Dashboard</a>
                         <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Administrasi</a>
                         <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Jasa</a>
                         <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Toko</a>
                         <a class="list-group-item list-group-item-action list-group-item-light p-3 {{Request::is('user/profile')?'active':''}}" href="{{route("user.profile")}}">Profile</a>
                         </div>
                    </div>
                    </div>
                    <div class="col-md-8">
                         @yield('content')
                    </div>
                    </div>
                    </p>
               </div>
          </section>
  </main><!-- End #main -->

  
  {{-- <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}

  {{-- @include('frontend.includes.footer') --}}
  @include('frontend.includes.scripts')


</body>

</html>