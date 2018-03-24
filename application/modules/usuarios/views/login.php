<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <?php echo link_tag('img/favicon.png', 'shortcut icon'); ?>
    <title><?php echo $title; ?></title>

    <!-- Icons -->
    <?php echo link_tag('assets/css/font-awesome.min.css'); ?>
    <?php echo link_tag('assets/css/simple-line-icons.css'); ?>
    <!-- Main styles for this application -->
    <?php echo link_tag('assets/css/style.css'); ?>

</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Inicio de sesión</h1>
                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-exclamation-triangle"></i> <?php echo $error; ?>
                            </div>
                            <?php endif; ?>
                            <?php echo form_open('login'); ?>
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input name="username" type="text" class="form-control" placeholder="Usuario">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input name="password" type="password" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">Entrar</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0">¿Olvidó su contraseña?</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>AVISO</h2>
                                <p>Para obtener acceso a la administración de su sitio web, debe de adquirir el paquete "Autoadministrable".</p>
                                <p>Si usted adquirió dicho paquete, puede ignorar este mensaje.</p>
                                <button type="button" class="btn btn-primary active mt-3">¡Mejorar mi plan!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



</body>

</html>