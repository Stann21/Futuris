@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="animation-preloader">
            <img class="logo-preloader" src="images/logo-origineel.png" alt="">
        </div>
    </div>

    <div class="background" style="display: none;">
        <div class="container">
        <div class="login col-8 offset-2 text-center">
            <img class="img-fluid col-4" src="images/logo-origineel.png">
            <p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                <a class="btn btn-primary btn-lg btn-margin" href="/activate" role="button">Eerste keer?</a>
            </p>
        </div>
        </div>
    </div>


    <script>
        document.onload(myFunction());

        function myFunction() {
            setTimeout(showPage, 4500);
        }

        function showPage() {
            document.querySelector(".animation-preloader").style.display = "none";
            document.querySelector(".background").style.display = "block";
        }
    </script>
@endsection

