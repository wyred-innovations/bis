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

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h6 class="logo-name">BIS</h6>

            </div>
            
            <p>Request New Verification Code.</p>
            <p class="text-danger"><?php if(isset($messages)){ echo $messages; } ?></p>
            <form id="sendVerification" >
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email / Username" required="" name="email">
                </div>
                
                <button class="btn btn-primary ladda ladda-button  block full-width m-b " data-url="/send-verification-code" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label">Request</span></button> </span>

                <a href="/"><small>You may login with different account.</small></a><br>
                <a href="/forgot-password"><small>Reset your password with your requested verification Code.</small></a>
                <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            --> </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/assets/js/jquery-2.1.1.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src ="/assets/plugins/Ladda-master/dist/spin.min.js" type="text/javascript"></script>
    <script src ="/assets/plugins/Ladda-master/dist/ladda.min.js" type="text/javascript"></script>
    <script src ="/assets/js/custom/laddaSave.js"></script>
    <script src="/assets/js/plugins/validate/jquery.validate.min.js"></script>


</html>
