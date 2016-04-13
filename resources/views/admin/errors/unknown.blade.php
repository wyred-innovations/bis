<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Benefeciaries Tracking System (BIS)</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="/system/img/SMIicon.ico">
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
@include('bis.csslinks.css_links')

</head>

<body class="skin-acf-io layout-top-nav" >
	<div class="jumbotron">
      <div class="container">
        <h1>Hey there mate!</h1>
        <p>You look lost? Perhaps maybe this link can redirect you to the page you are looking for.</p>
        <p><a class="btn btn-primary btn-lg" href="/" role="button">&raquo; Home </a></p>
      </div>
    </div>
</body>
</html>

