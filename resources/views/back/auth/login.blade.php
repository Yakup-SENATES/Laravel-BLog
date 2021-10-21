<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Changir Hanzade - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('back')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('back')}}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info py-5">

    <div class="container py-5">

        <!-- Outer Row -->
        <div class="row justify-content-center my-5">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-light">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"> {{--bg-login-image--}}
								<img src="http://www.cihangirgrup.com.tr/wp-content/uploads/2017/02/logolar-cihangir-1024x683.png" style="width: 450px ; padding: 5px ">
							</div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hoşgeldiniz !</h1>
                                    </div>
                                
                                  
                                    <form class="user" method="post" action="{{route('loginPost')}}">
                                        
                                        @if (Session::get('fail'))
                                            <div class="alet alert-danger">
                                                {{Session::get('fail')}}
                                            </div>
                                        @endif

                                        @csrf

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <span class="text-danger"> @error('email'){{ $message}} @enderror </span>
                                              
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                     <div class="form-group row">
                                      <div class="col-md-6 offset-md-4">
                                      <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ?     'checked' : '' }}>

                                      <label class="form-check-label" for="remember">
                                         {{ __('Remember Me') }}
                                      </label>
                                  </div>
                                </div>
                           </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>                    
                            </div>
                          </div>
                    </form>
                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('back')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('back')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('back')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('back')}}/js/sb-admin-2.min.js"></script>

</body>

</html>