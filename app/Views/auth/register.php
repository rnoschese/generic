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
            <!-- REGISTER -->
            <section id="register" class="visible">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="login-box-plain">
                                <h2 class="bigintro">Register</h2>
                                <div class="divide-40"></div>
                                <form role="form" method="post" action="auth/save" id="frm_register">
                                    <div class="form-group">
                                        <label for="exampleInputName">Nome</label>
                                        <i class="fa fa-font"></i>
                                        <input type="text" class="form-control" id="exampleInputName" name="nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername">Cognome</label>
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="form-control" id="exampleInputUsername" name="cognome">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                    </div>
                                    <div class="form-group"> 
                                        <label for="exampleInputPassword1">Password</label>
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" id="exampleInputPassword1" >
                                    </div>
                                    <div class="form-actions">
                                        <label class="checkbox"> <div class="checker"><span><input type="checkbox" class="uniform" value=""></span></div> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                                        <button type="submit" class="btn btn-success" id="btn_submit">Sign Up</button>
                                    </div>
                                </form>

                                <div class="login-helpers">
                                    <a href="login"> Effettua il login</a> <br>
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
        <script src="js/jquery/jquery-2.0.3.min.js"></script>
        <!-- JQUERY UI-->
        <script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
        <!-- BOOTSTRAP -->
        <script src="bootstrap-dist/js/bootstrap.min.js"></script>


        <!-- UNIFORM -->
        <script type="text/javascript" src="js/uniform/jquery.uniform.min.js"></script>
        <!-- CUSTOM SCRIPT -->
        <script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
        <script src="js/forms.js"></script>
        <script src="js/sha512.js"></script>
        <script src="js/script.js"></script>
        <script>
            jQuery(document).ready(function () {
                App.setPage("register");  //Set current page
                App.init(); //Initialise plugins and elements
            });
            
            jQuery('#btn_submit').on('click',this,function(e){
                e.preventDefault();
                jQuery('<input/>',{
                    val: hex_sha512(jQuery('#exampleInputPassword1').val()),
                    type: 'hidden',
                    name: 'p'
                }).appendTo('#frm_register');
                
                jQuery('#exampleInputPassword1').val('');
                $('#frm_register').submit();
            });
        </script>
    </body>
</html>