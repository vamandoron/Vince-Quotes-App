<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('css/foundation.css')}}" />

</head>

<body>
<!-- Header and Nav -->

@include('header')
<!-- End Header and Nav -->

<div class="row">
    <div class="large-12">
        &nbsp;
        @if (Session::has('message'))
            <div class="callout success">
                {{Session::get('message')}}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<!-- Footer -->
<footer class="row">
    <div class="large-12 columns">
        <hr />
        <div class="row">
            <div class="large-6 columns">
                <p>&copy; Sample</p>
            </div>
        </div>
    </div>
</footer>

<script src="js/foundation.min.js"></script>
<script src="js/vendor/jquery.min.js"></script>
<script src="js/app.js"></script>
<script>
    $(document).foundation();
</script>


</body>
</html>
