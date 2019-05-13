@extends('layouts.login')

@section('content')
<div class="container">
    <div class="animation-preloader">
        <img class="logo-preloader" src="images/logo-origineel.png" alt="">
    </div>

    <p class="test" style="display: none">hallo</p>
</div>

<script>
    var myVar;

    document.onload(myFunction());

    function myFunction() {
        myVar = setTimeout(showPage, 4500);
    }

    function showPage() {
        document.querySelector(".animation-preloader").style.display = "none";
        document.querySelector(".test").style.display = "block";
    }
</script>

@endsection

