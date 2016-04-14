<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BIS</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    @include('bis.csslinks.css_crud')
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h6 class="logo-name">BIS</h6>

            </div>
            
            <p>Reset your password.</p>
            <p class="text-danger"><?php if(isset($messages)){ echo $messages; } ?></p>
            <form id="forgotPassoword">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email / Username" required="" name="email">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="verification code" required="" name="verification_code">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="New Password" required="" name="new_password">
                </div>
                
                <button class="btn btn-primary ladda ladda-button  block full-width m-b " data-url="/password-reset" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label">Reset</span></button> </span>

                <a href="/request-verification-code"><small>Request Verification Code?</small></a>
                <br>
                <a href="/admin/security/login/Authentication"><small>Log In</small></a>

                <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            --> </form>
        </div>
    </div>

    @include('bis.jslinks.js_initial')
    @include('bis.jslinks.js_final')
    @include('bis.jslinks.js_crud')

</body>

</html>
