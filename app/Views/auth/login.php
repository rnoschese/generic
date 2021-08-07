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
        <link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >

        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- DATE RANGE PICKER -->
        <link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <!-- UNIFORM -->
        <link rel="stylesheet" type="text/css" href="js/uniform/css/uniform.default.min.css" />
        <!-- ANIMATE -->
        <link rel="stylesheet" type="text/css" href="css/animatecss/animate.min.css" />
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
                                <a href="index.html"><img src="img/logo/logo-alt.png" height="40" alt="logo name" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/NAV-BAR -->
            </header>
            <!--/HEADER -->
            <!-- LOGIN -->
            <section id="login" class="visible">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="login-box-plain">
                                <h2 class="bigintro">Sign In</h2>
                                <div class="divide-40"></div>
                                
                                <?php
                                $session = session();
                                if ($session->getFlashdata('msg')):
                                ?>
                                    <div class="alert alert-block alert-danger fade in">
                                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                                        <h4><i class="fa fa-exclamation-circle"></i> Warning</h4>
                                        <p><?= $session->getFlashdata('msg'); ?></p>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                if ($session->getFlashdata('msg-success')):
                                ?>
                                    <div class="alert alert-block alert-success fade in">
                                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                                        <h4><i class="fa fa-exclamation-circle"></i> Info</h4>
                                        <p><?= $session->getFlashdata('msg-success'); ?></p>
                                    </div>
                                <?php endif; ?>

                                <form role="form" method="post" action="auth/login" id="frm_login">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                    </div>
                                    <div class="form-group"> 
                                        <label for="exampleInputPassword1">Password</label>
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" id="exampleInputPassword1" >
                                    </div>
                                    <div class="form-actions">
                                        <label class="checkbox"> <input type="checkbox" class="uniform" value=""> Remember me</label>
                                        <button type="submit" class="btn btn-danger" id="btn_submit">Submit</button>
                                    </div>
                                </form>

                                <div class="login-helpers">
                                    <a href="reset_password">Password dimenticata?</a> <br>
                                    Non hai ancora un account? <a href="register">Registrati ora!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/LOGIN -->
        </section>
        <!--/PAGE -->
        <!-- JAVASCRIPTS -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- JQUERY -->
        <script src="js/jquery/jquery-2.0.3.min.js"></script>
        <!-- JQUERY UI-->
        <script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
        <!-- BOOTSTRAP -->
        <script src="bootstrap-dist/js/bootstrap.min.js"></script>


        <!-- UNIFORM -->
        <script type="text/javascript" src="js/uniform/jquery.uniform.min.js"></script>
        <!-- CUSTOM SCRIPT -->
        <script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
        <script src="js/sha512.js"></script>
        <script src="js/script.js"></script>
        <script>
            jQuery(document).ready(function () {
                App.setPage("login");  //Set current page
                App.init(); //Initialise plugins and elements
            });

            jQuery('#btn_submit').on('click', this, function (e) {
                jQuery('<input/>', {
                    val: hex_sha512(jQuery('#exampleInputPassword1').val()),
                    type: 'hidden',
                    name: 'p'
                }).appendTo('#frm_login');

                jQuery('#exampleInputPassword1').val('');
            });
        </script>
    </body>
</html>