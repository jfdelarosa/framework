<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <?php echo link_tag('assets/img/favicon.ico', 'shortcut icon'); ?>
    <title>Login</title>
    <?php echo link_tag('assets/css/dashboard.css'); ?>
    <?php echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); ?>
    <?php echo link_tag('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext'); ?>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./assets/brand/tabler.svg" class="h-6" alt="">
              </div>
              <?php echo form_open('login', array("class" => "card")); ?>
                <div class="card-body p-6">
                  <div class="card-title">Ingresar al panel de control</div>
                  <?php if(isset($error)): ?>
                  <div class="alert alert-icon alert-danger" role="alert">
                      <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="username" class="form-control" placeholder="Ingresar nombre de usuario">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Contraseña
                      <a href="./recuperar" class="float-right small">Olvidé mi contraseña</a>
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Ingresar su contraseña">
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>