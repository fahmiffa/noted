@extends('auth.layout')
@section('main')
<div class="container">

  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

      
          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
            
              <p class="text-center small"> 
                <a href="{{route('home')}}"><img src="{{asset('assets/img/logo.png')}}" width="150px" height="150px"> </a>
             </p>
                <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                <p class="text-center small">Masukkan Username dan Password</p>
              </div>

              <form method="POST" class="row g-3 needs-validation"  action="{{route('log')}}" novalidate>
              @csrf
                <div class="col-12">
                  <label for="yourUsername" class="form-label">Username</label>
                  <div class="input-group has-validation">                        
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" id="email" required>
                    <div class="invalid-feedback">Masukkan Username</div>
                  </div>
                  @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" value="{{old('password')}}" id="yourPassword" required>
                  <div class="invalid-feedback">Masukkan Password</div>
                </div>   
                <div class="col-12">                
                  <div class="captcha py-3">
                    <span class="w-100">{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload"><i class="bi bi-arrow-clockwise"></i></button>                                      
                  </div>
                  <input type="text" name="captcha" placeholder="Enter Captcha" class="form-control" id="captcha" required>
                  @error('captcha')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100 p-1 mb-3" type="submit">Login</button>                            
                </div>          
              </form>

            </div>
          </div>

          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
          </div>

        </div>
      </div>
    </div>

  </section>

</div>

@push('js')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endpush
@endsection