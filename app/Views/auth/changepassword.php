<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Cloud Admin | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" href="<?=base_url('css/cloud-admin.css')?>" >

        <link rel="stylesheet" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>">
        <!-- DATE RANGE PICKER -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('js/bootstrap-daterangepicker/daterangepicker-bs3.css')?>" />
        <!-- UNIFORM -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('js/uniform/css/uniform.default.min.css')?>" />
        <!-- ANIMATE -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('css/animatecss/animate.min.css')?>" />
        <!-- FONTS -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    </head>
    <body class="login">	
        <!-- PAGE -->
        <section id="page">
            <!-- HEADER -->
            <header>
                <!-- NAV-BAR -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div id="logo">
                                <a href="index.html"><img src="<?=base_url('img/logo/logo-alt.png')?>" height="40" alt="logo name" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/NAV-BAR -->
            </header>
            <!--/HEADER -->
            <!-- REGISTER -->
            <section id="register" class="visible">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="login-box-plain">
                                <h2 class="bigintro">Reset password</h2>
                                <div class="divide-40"></div>
                                
                                <div class="alert alert-block alert-danger fade in hidden">
                                    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                                    <h4><i class="fa fa-exclamation-circle"></i> Warning</h4>
                                    <p>Le password inserite non sono uguali.</p>
                                </div>
                                <?php $uri = service('uri');?>
                                
                                <form role="form" method="post" action="<?= site_url('auth/changePassword/' . $uri->getSegment(2)); ?>" id="frm_register">
                                    <div class="form-group"> 
                                        <label for="pw1">Password</label>
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" id="pw1" name="password" >
                                    </div>
                                    <div class="form-group"> 
                                        <label for="pw1">Ripeti Password</label>
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" id="pw2" name="password" >
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success" id="btn_submit">Sign Up</button>
                                    </div>
                                </form>
                                <!-- SOCIAL REGISTER -->
                                <div class="divide-20"></div>
                                <div class="center">
                                    <strong>Or register using your social account</strong>
                                </div>
                                <div class="divide-20"></div>
                                <div class="social-login center">
                                    <a class="btn btn-primary btn-lg">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a class="btn btn-info btn-lg">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a class="btn btn-danger btn-lg">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                                <!-- /SOCIAL REGISTER -->
                                <div class="login-helpers">
                                    <a href="<?=base_url('login')?>"> Effettua il login</a> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/REGISTER -->
        </section>
        <!--/PAGE -->
        <!-- JAVASCRIPTS -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- JQUERY -->
        <script src="<?=base_url('js/jquery/jquery-2.0.3.min.js')?>"></script>
        <!-- JQUERY UI-->
        <script src="<?=base_url('js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js')?>"></script>
        <!-- BOOTSTRAP -->
        <script src="<?=base_url('bootstrap-dist/js/bootstrap.min.js')?>"></script>


        <!-- UNIFORM -->
        <script type="text/javascript" src="<?=base_url('js/uniform/jquery.uniform.min.js')?>"></script>
        <!-- CUSTOM SCRIPT -->
        <script type="text/javascript" src="<?=base_url('js/jQuery-Cookie/jquery.cookie.min.js')?>"></script>
        <script src="<?=base_url('js/forms.js')?>"></script>
        <script src="<?=base_url('js/sha512.js')?>"></script>
        <script src="<?=base_url('js/script.js')?>"></script>
        <script>
            jQuery(document).ready(function () {
                App.setPage("register");  //Set current page
                App.init(); //Initialise plugins and elements
            });
            
            jQuery('#frm_register').submit(function(){
                
                
                if(jQuery('#pw1').val() === jQuery('#pw2').val()){
                    jQuery('.alert').addClass('hidden');
                    jQuery('<input/>',{
                        val: hex_sha512(jQuery('#pw1').val()),
                        type: 'hidden',
                        name: 'p'
                    }).appendTo('#frm_register');
                    jQuery('#frm_register').submit();
                }else{
                    jQuery('.alert').removeClass('hidden');
                    return false;
                }
                
                jQuery('#pw1').val('');
                jQuery('#pw2').val('');
            });
        </script>
    </body>
</html>