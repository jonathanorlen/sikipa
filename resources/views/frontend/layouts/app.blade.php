<!DOCTYPE html>
<html lang="en">

<head>
  @include('frontend.includes.styles')
</head>

<body>
  @include('frontend.includes.header')
  
  @yield('hero')

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  
  {{-- <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}

  {{-- @include('frontend.includes.footer') --}}
  @include('frontend.includes.scripts')
</body>

</html>