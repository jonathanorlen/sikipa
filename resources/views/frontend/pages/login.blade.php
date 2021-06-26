@extends('frontend.layouts.app')
@section('content')
      <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height:100vh">

     <div class="container">
       <div class="row">
         <div class="col-lg-8 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
           <h1>Login</h1>
         </div>
         <div class="col-lg-4 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          @if (session()->has('error'))
          <div class="alert alert-danger" role="alert">
              {{ session()->get('error') }}
          </div>
          @endif
          <form class="card px-4 py-4" action="{{route('login-authenticate')}}" method="POST">
            @csrf   
            <div class="mb-3">
                 <label for="email" class="form-label">Email address</label>
                 <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                 @error('email')
                     {{ $message }}
                 @enderror
               </div>
               <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" name="password" class="form-control" id="password">
                  @error('password')
                    {{ $message }}
                  @enderror
                </div>
               <div class="mb-3 form-check">
                 <input type="checkbox" class="form-check-input" id="exampleCheck1">
                 <label class="form-check-label" for="exampleCheck1">Check me out</label>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
             </form>
         </div>
       </div>
     </div>
 
   </section><!-- End Hero -->
@endsection