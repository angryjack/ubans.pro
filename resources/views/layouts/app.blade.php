<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="/css/libs/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/libs/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/css/libs/select2/css/select2.min.css" rel="stylesheet">
    <link href="/css/libs/jquery.steps/css/jquery.steps.css" rel="stylesheet">
    <link href="/css/libs/datatables/css/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/slim.min.css">
    @if(env('THEME_BLACK'))
        <link rel="stylesheet" href="/css/slim.one.css">
    @endif

    <link rel="stylesheet" href="/css/dashboard.css">
    <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47193411 = new Ya.Metrika({ id:47193411, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47193411" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
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
<script src="/js/libs/select2.min.js"></script>
<script src="/js/libs/jquery-ui.js"></script>
<script src="/js/libs/moment.js"></script>
<script src="/js/libs/bootstrap-tagsinput.js"></script>
<script src="/js/libs/jquery.steps.js"></script>
<script src="/js/libs/parsley.js"></script>
<script src="/js/libs/ru.js"></script>

<script src="/js/components/BuyPrivilege.js"></script>
<script src="/js/components/Signin.js"></script>
<script src="/js/components/User.js"></script>
<script src="/js/components/Donation.js"></script>
<script src="/js/components/Profile.js"></script>
<script src="/js/components/Bans.js"></script>
<script src="/js/components/Users.js"></script>
<script src="/js/dashboard.js"></script>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 71318793, {tooltipButtonText: "Есть вопрос?"});
</script>

</body>
</html>
