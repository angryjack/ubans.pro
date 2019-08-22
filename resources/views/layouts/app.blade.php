<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <link href="/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="/lib/jquery.steps/css/jquery.steps.css" rel="stylesheet">
    <link href="/lib/datatables/css/jquery.dataTables.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/slim.min.css">
    @if(env('THEME_BLACK'))
        <link rel="stylesheet" href="/css/slim.one.css">
    @endif

    <link rel="stylesheet" href="/css/dashboard.css">

</head>
<body>
@include('layouts.header')

@include('layouts.navbar')

<div class="slim-mainpanel">
    @yield('content')
</div>

@include('layouts.footer')

<script src="/js/libs/jquery.js"></script>
<script src="/js/libs/popper.js"></script>
<script src="/js/libs/bootstrap.min.js"></script>
<script src="/lib/select2/js/select2.min.js"></script>
<script src="/lib/jquery-ui/js/jquery-ui.js"></script>
<script src="/lib/moment/js/moment.js"></script>
<script src="/lib/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script src="/lib/jquery.steps/js/jquery.steps.js"></script>
<script src="/lib/parsleyjs/js/parsley.js"></script>
<script src="/lib/parsleyjs/js/ru.js"></script>
<script src="/js/components/BuyPrivilege.js"></script>
<script src="/js/components/Signin.js"></script>
<script src="/js/components/User.js"></script>
<script src="/js/components/Donation.js"></script>
<script src="/js/components/Profile.js"></script>
<script src="/js/dashboard.js"></script>


</body>
</html>
