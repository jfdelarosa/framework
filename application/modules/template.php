<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <?php echo link_tag('img/favicon.png', 'shortcut icon'); ?>
    <title><?php echo $title; ?></title>

    <!-- Icons -->
    <?php echo link_tag('assets/css/font-awesome.min.css'); ?>
    <?php echo link_tag('assets/css/simple-line-icons.css'); ?>
    <!-- Main styles for this application -->
    <?php echo link_tag('assets/css/style.css'); ?>
</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="http://coreui.io/demo/Ajax_Demo/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none"><?php echo $this->session->user_username; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
                    <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="/backend/login/logout/"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <?php echo $menu; ?>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
            <?php echo $this->breadcrumbs->show(); ?>
            <div class="container-fluid">
                <?php if(isset($alert)): ?>
                <div class="card text-white text-center <?php echo $alert['type']; ?>">
                    <div class="card-body">
                      <?php echo $alert['text']; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php echo (isset($content)) ? $content : ""; ?>


            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <footer class="app-footer">
        <a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.
        <span class="float-right">Powered by <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>

    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/bower_components/popper.js/index.js"></script>
    <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/bower_components/pace/pace.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <?php if(isset($scripts)): ?>
    <?php foreach($scripts as $js): ?>
    <script src="<?php echo $js; ?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>