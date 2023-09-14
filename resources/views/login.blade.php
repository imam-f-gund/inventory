<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/svg/logo.svg') }}" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">

    <style>
        .login-header {
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
                        <h2 class="fw-bold text-center mb-6 login-header">Inventory</h2>
                    </div>
                </div>
                <label class="form-label-wrapper">
                    <p class="form-label">Username</p>
                    <input class="form-input" type="text" placeholder="Enter your username" name="username" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Password</p>
                    <input class="form-input" type="password" placeholder="Enter your password" name="password"
                        required>
                </label>

                <button type="button" id="btnLogin" class="form-btn secondary-default-btn">Masuk</button>
                <a href="{{url('/register')}}" type="button" id="btnLogin" class="form-btn primary-default-btn">Register</a>
       
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
        var url = "{{ url('api/login') }}";
        var urlLogout = "{{ url('api/logout') }}";
        $('#btnLogin').click(function() {
            document.getElementById("btnLogin").disabled = true;
            $('#btnLogin').html(`<span>Loading...</span>`);
            
            form = $("#formAuthentication");

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
            }).done(function(response, responseText, xhr) {
               
                if (xhr.status === 201) {
                    var errVal = response.message;
                    $.each(errVal, function(i, val) {
                        $('label[for="' + i + '"]').addClass('text-danger');
                        let input = document.getElementById(i)
                        let messageInput = document.getElementById(i + "Help");
                        messageInput.style.display = "block";
                        messageInput.innerHTML = val;
                        input.classList.add('is-invalid');
                        input.classList.add('text-danger');
                    });
                    
                    $('#btnLogin').html(`<span>Login</span>`);
                    document.getElementById("btnLogin").disabled = false;
                } else {
                   
                    // if (response.data.user.role_id == '1') {
                        localStorage.setItem('token', response.data.token);
                        // document.getElementById("btnLogin").disabled = false;
                        window.location.href = "{{ url('/') }}";
                    // } else {
                    //     $.ajax({
                    //         type: 'POST',
                    //         url: urlLogout,
                    //         headers: {
                    //             "Authorization": "Bearer " + response.data.token,
                    //         }
                    //     }).done(function(lresponse, lresponseText, lxhr) {
                    //         if (lxhr.status === 201) {
                    //             console.log("error");
                    //         } else {
                    //             localStorage.htmlItem("token");
                    //             window.location = "{{ url('login') }}";
                    //         }
                    //     }).fail(function(jqXHR, textStatus, errorThrown) {
                    //         console.log("error");
                    //     });
                    //     $('#btnLogin').html(`<span>Login</span>`);
                    //     document.getElementById("btnLogin").disabled = false;
                    // }

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                var err = JSON.parse(jqXHR.responseText);
                Swal.fire({
                    title: 'Error !',
                    text: err.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                $('#btnLogin').html(`<span>Login</span>`);
                document.getElementById("btnLogin").disabled = false;
            })
        })
    </script>
</body>

</html>
