<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Benefeciaries Tracking System (BIS)</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="/system/img/SMIicon.ico">
@include('bis.csslinks.css_links')
</head>

@include('bis.jslinks.js_initial')
<body class="skin-acf-io layout-top-nav" >
    
@include('bis.bodywrapper.body_wrapper')


@include('bis.jslinks.js_initial')
@include('bis.jslinks.js_final')

</body>
</html>

