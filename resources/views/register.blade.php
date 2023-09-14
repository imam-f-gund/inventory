<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/svg/logo.svg') }}" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">

    <style>
        .register-header {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;

        }

        .form-btn {
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">

            <form class="sign-up-form form mt-5" action="" id="formAuthentication" method="POST">
               
                <div class="row">
                    <div class="col text-center">
                        <h2 class="fw-bold text-center mb-6 register-header">Register</h2>
                    </div>
                </div>
                <label class="form-label-wrapper">
                    <p class="form-label">First Name</p>
                    <input class="form-input" type="text" placeholder="Enter your first_name" name="first_name" id="first_name" required>
                </label>
                 <label class="form-label-wrapper">
                    <p class="form-label">Last Name</p>
                    <input class="form-input" type="text" placeholder="Enter your last_name" name="last_name" id="last_name" required>
                </label>
                 <label class="form-label-wrapper">
                    <p class="form-label">Email</p>
                    <input class="form-input" type="email" placeholder="Enter your email" id="email" name="email" required>
                </label>
                 <label class="form-label-wrapper">
                    <p class="form-label">Username</p>
                    <input class="form-input" type="text" placeholder="Enter your username" id="username" name="username" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input class="form-input" type="password" placeholder="Enter your password" name="password" id="password"
                        required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Confim Password</p>
                    <input class="form-input" type="password" placeholder="Enter your confim_password" name="confim_password" id="confim_password"
                        required>
                </label>
                

                <button type="button" id="btnregister" class="form-btn secondary-default-btn">Register</button>
                <a href="{{url('/login')}}" type="button" class="form-btn primary-default-btn">Login</a>
       
            </form>
        
        </article>
    </main>
    <!-- Chart library -->
    <script src="{{ asset('plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    @include('template.adminlte.layouts.js')

    @yield('js')
    @if ($errors->any())
        <div id="ERROR_COPY" style="display: none;" class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h6>{{ $error }}</h6>
            @endforeach
        </div>
    @endif

    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <script type="text/javascript">
        var cekError = {{ $errors->any() > 0 ? 'true' : 'false' }};
        var ht = $("#ERROR_COPY").html();
        if (cekError) {
            Swal.fire({
                title: 'Errors',
                icon: 'error',
                html: ht,
                showCloseButton: true,
            });
        }
    </script>
    @include('sweetalert::alert')
    
    <script>
        var url = "{{ url('api/register') }}";
        $('#btnregister').click(function() {
            document.getElementById("btnregister").disabled = true;
            $('#btnregister').html(`<span>Loading...</span>`);
            
            form = $("#formAuthentication");

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
            }).done(function(response, responseText, xhr) {
               var errorArr = [];
                if (xhr.status === 201) {
                    var errVal = response.message;
                    
                    for (const [key, value] of Object.entries(errVal)) {
                        errorArr.push(key);
                    }
                   
                    console.log(errorArr);
                    Swal.fire({
                        title: 'Error !',
                        text: 'Mohon cek '+errorArr,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    $('#btnregister').html(`<span>register</span>`);
                    document.getElementById("btnregister").disabled = false;
                
                } else {
                
                    Swal.fire({
                        title: 'Success !',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    $('#btnregister').html(`<span>register</span>`);
                    document.getElementById("btnregister").disabled = false;
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                var err = JSON.parse(jqXHR.responseText);
                Swal.fire({
                    title: 'Error !',
                    text: err.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $('#btnregister').html(`<span>register</span>`);
                document.getElementById("btnregister").disabled = false;
            })
        })
    </script>
</body>

</html>
