<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Inicio de Sesion</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo base_url()?>registro/validar">
                                            <div class="form-group ">
                                                <label class="small mb-1" for="inputEmail">Usuario</label>
                                                <input class="form-control" id="inputEmail" type="text" placeholder="Ingresa tu usuario" name="usuario" 
                                                value="<?php echo set_value('usuario')?>"
                                                />
                                            </div>

                                            <div class="form-group ">
                                            <label class="small mb-1" for="inputPassword">Contraseña</label>    
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Ingresa tu contraseña" name="password"
                                             value="<?php echo set_value('password')?>"
                                            />
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                           
                                                <button class="btn btn-primary" type="submit">Enviar</button>
                                                 
                                            </div>
                                            <?php if(isset($validation)){?>
                                            <div class="alert alert-danger">
                                            <?php echo $validation ->listErrors();?>
                                            </div>
                                            <?php } ?> 

                                            <?php if(isset($error)){?>
                                                <div class="alert alert-danger">
                                            <?php echo $error;?>
                                            </div>
                                            <?php } ?> 
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; RiverSafe <?php echo date('Y')?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>/js/datatables-simple-demo.js"></script>
    </body>
</html>
