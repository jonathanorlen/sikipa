@extends('frontend.layouts.app')
@section('content')
  <section id="hero-auth" class="d-flex align-items-center">
     <div class="container">
       <div class="row">
         <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
           <h1 class="text-light">Register</h1>
         </div>
         <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <form class="card px-4 py-4" action="{{route('register-create')}}" method="POST">
              @csrf
              <div class="row">
                <div class="mb-2 col-md-6">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-6">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" name="nik" value="{{ old('nik') }}" class="form-control  @error('nik') is-invalid @enderror" id="nik">
                  @error('nik')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-12">
                  <label for="alamat" class="form-label">Alamat Lengkap</label>
                  <input type="alamat" name="alamat" value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" id="alamat">
                  @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-6 col-6">
                  <label for="rt" class="form-label">RT</label>
                  <input type="number" name="rt" value="{{ old('rt') }}" class="form-control @error('rt') is-invalid @enderror" id="rt">
                  @error('rt')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-6 col-6">
                  <label for="rw" class="form-label">RW</label>
                  <input type="number" name="rw" value="{{ old('rw') }}" class="form-control @error('rw') is-invalid @enderror" id="rw">
                  @error('rw')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email">
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-2 col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                  @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                {{-- <div class="mb-2 col-md-6">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
              </div>
               <button type="submit" class="btn btn-primary">Submit</button>
             </form>
         </div>
       </div>
     </div>
 
   </section><!-- End Hero -->
@endsection