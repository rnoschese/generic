<?php 
$session = session();
$usr = $session->get('user');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?= APPNAME . ' - ' . esc($title); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/cloud-admin.css') ?>" >
        <link rel="stylesheet" type="text/css"  href="<?= base_url('public/css/themes/default.css') ?>" id="skin-switcher" >
        <link rel="stylesheet" type="text/css"  href="<?= base_url('public/css/responsive.css') ?>" >
        
        <link href="<?= base_url('public/font-awesome/css/all.css') ?>" rel="stylesheet">
        <link href="<?= base_url('public/font-awesome-rem/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- DATE RANGE PICKER -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('public/js/bootstrap-daterangepicker/daterangepicker-bs3.css') ?>" />
        <!-- BOOTSTRAP SWITCH -->
	    <link rel="stylesheet" type="text/css" href="<?= base_url('public/js/bootstrap-switch/bootstrap-switch.min.css') ?>" />
	    <link rel="stylesheet" type="text/css" href="<?= base_url('public/js/select2/dist/css/select2.min.css') ?>" />
	    <link rel="stylesheet" type="text/css" href="<?= base_url('public/js/select2/dist/css/select2.bootstrap.css') ?>" />

        <!-- FONTS -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
        
        
        <!-- JAVASCRIPTS -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- JQUERY -->
        <script src="<?= base_url('public/js/jquery/jquery-2.0.3.min.js') ?>"></script>
        <!-- JQUERY UI-->
        <script src="<?= base_url('public/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
        <!-- BOOTSTRAP -->
        <script src="<?= base_url('public/bootstrap-dist/js/bootstrap.min.js') ?>"></script>


        <!-- DATE RANGE PICKER -->
        <script src="<?= base_url('public/js/bootstrap-daterangepicker/moment.min.js') ?>"></script>

        <script src="<?= base_url('public/js/bootstrap-daterangepicker/daterangepicker.min.js') ?>"></script>
        <!-- SLIMSCROLL -->
        <script type="text/javascript" src="<?= base_url('public/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('public/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js') ?>"></script>
        
        <!-- COOKIE -->
        <script type="text/javascript" src="<?= base_url('public/js/jQuery-Cookie/jquery.cookie.min.js') ?>"></script>
        <!-- CUSTOM SCRIPT -->
        <script src="<?= base_url('public/js/script.js') ?>"></script>
        <script src="<?= base_url('public/js/custom.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('public/js/select2/dist/js/select2.full.min.js') ?>"></script>
        
        <!-- BOOTSTRAP SWITCH -->
	    <script type="text/javascript" src="<?= base_url('public/js/bootstrap-switch/bootstrap-switch.min.js') ?>"></script>
        <!-- BOOTSTRAP SWITCH -->


        <script>
            jQuery(document).ready(function () {
                App.setPage("widgets_box");  //Set current page
                App.init(); //Initialise plugins and elements
            });
        </script>
        <!-- /JAVASCRIPTS -->
    </head>
    <body>
        <!-- HEADER -->
        <header class="navbar clearfix navbar-fixed-top" id="header">
            <div class="container">
                <div class="navbar-brand">
                    <!-- COMPANY LOGO -->
                    <a href="index.html">
                        <img src="<?= base_url('public/img/logo/logo.png') ?>" alt="Cloud Admin Logo" class="img-responsive" height="30" width="120">
                    </a>
                    <!-- /COMPANY LOGO -->
                    <!-- TEAM STATUS FOR MOBILE -->
                    <div class="visible-xs">
                        <a href="#" class="team-status-toggle switcher btn dropdown-toggle">
                            <i class="fa fa-users"></i>
                        </a>
                    </div>
                    <!-- /TEAM STATUS FOR MOBILE -->
                    <!-- SIDEBAR COLLAPSE -->
                    <div id="sidebar-collapse" class="sidebar-collapse btn">
                        <i class="fa fa-bars" 
                           data-icon1="fa fa-bars" 
                           data-icon2="fa fa-bars" ></i>
                    </div>
                    <!-- /SIDEBAR COLLAPSE -->
                </div>
                
                
                <!-- BEGIN TOP NAVIGATION MENU -->					
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->	
                    <li class="dropdown" id="header-notification">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge">7</span>

                        </a>
                        <ul class="dropdown-menu notification">
                            <li class="dropdown-title">
                                <span><i class="fa fa-bell"></i> 7 Notifications</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success"><i class="fa fa-user"></i></span>
                                    <span class="body">
                                        <span class="message">5 users online. </span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>Just now</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary"><i class="fa fa-comment"></i></span>
                                    <span class="body">
                                        <span class="message">Martin commented.</span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>19 mins</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-warning"><i class="fa fa-lock"></i></span>
                                    <span class="body">
                                        <span class="message">DW1 server locked.</span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>32 mins</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-info"><i class="fa fa-twitter"></i></span>
                                    <span class="body">
                                        <span class="message">Twitter connected.</span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>55 mins</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="fa fa-heart"></i></span>
                                    <span class="body">
                                        <span class="message">Jane liked. </span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2 hrs</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span>
                                    <span class="body">
                                        <span class="message">Database overload.</span>
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>6 hrs</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="footer">
                                <a href="#">See all notifications <i class="fa fa-arrow-circle-right"></i></a>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <li class="dropdown" id="header-message">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="badge">3</span>
                        </a>
                        <ul class="dropdown-menu inbox">
                            <li class="dropdown-title">
                                <span><i class="fa fa-envelope-o"></i> 3 Messages</span>
                                <span class="compose pull-right tip-right" title="Compose message"><i class="fa fa-pencil-square-o"></i></span>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= base_url('public/img/avatars/avatar2.jpg') ?>" alt="" />
                                    <span class="body">
                                        <span class="from">Jane Doe</span>
                                        <span class="message">
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
                                        </span> 
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>Just Now</span>
                                        </span>
                                    </span>

                                </a>
                            </li>
                            
                            <li class="footer">
                                <a href="#">See all messages <i class="fa fa-arrow-circle-right"></i></a>
                            </li>
                        </ul>
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN TODO DROPDOWN -->
                    <li class="dropdown" id="header-tasks">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">3</span>
                        </a>
                        <ul class="dropdown-menu tasks">
                            <li class="dropdown-title">
                                <span><i class="fa fa-check"></i> 6 tasks in progress</span>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="header clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">60%</span>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="header clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">25%</span>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                            <span class="sr-only">25% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="header clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">40%</span>
                                    </span>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                                            <span class="sr-only">40% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="header clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">70%</span>
                                    </span>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="header clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">65%</span>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 35%">
                                            <span class="sr-only">35% Complete (success)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-warning" style="width: 20%">
                                            <span class="sr-only">20% Complete (warning)</span>
                                        </div>
                                        <div class="progress-bar progress-bar-danger" style="width: 10%">
                                            <span class="sr-only">10% Complete (danger)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="footer">
                                <a href="#">See all tasks <i class="fa fa-arrow-circle-right"></i></a>
                            </li>
                        </ul>
                    </li>
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user" id="header-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img alt="" src="<?= base_url('public/img/avatars/avatar3.jpg')?>" />
                            <span class="username"><?= ucfirst($usr['nome'])?> <?= ucfirst($usr['cognome'])?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="/members"><i class="fa fa-cog"></i> Gestione utenti</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Privacy Settings</a></li>
                            <li><a href="/login/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->
            </div>

        </header>
        <!--/HEADER -->
        
        <section id="page">