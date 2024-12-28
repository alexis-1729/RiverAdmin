<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iniciar Sesion- RiverAdmin</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>/css/styles2.css" rel="stylesheet" />

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="gradiante">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class=" d-flex justify-content-center aling-items-center cont">
                            
                                <!-- <a class="logoAdmin" 
                                href="<?php echo base_url()?>"><img src="<?php echo base_url();?>assets/img/RiverlogoCircular.png" alt="logo" width="200" height="200"></a>
                         -->
                            <div class="col-lg-5  pl-28">
                                <div class="card loginf bg-cyan-950 shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center text-lg font-bold my-4">Inicio de Sesion</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo base_url()?>registro/validar">
                                            <div class="loginInput">
                                                <label class="text-base font-medium mb-1" for="inputEmail">Usuario</label>
                                                <input class="bg-cyan-900" id="inputEmail" type="text" placeholder="Ingresa tu usuario" name="usuario" 
                                                value="<?php echo set_value('usuario')?>"
                                                />
                                            </div>

                                            <div class="loginInput ">
                                            <label class="text-base font-medium mb-1" for="inputPassword">Contraseña</label>    
                                            <input class="bg-cyan-900" id="inputPassword" type="password" placeholder="Ingresa tu contraseña" name="password"
                                             value="<?php echo set_value('password')?>"
                                            />
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-3 mb-0">
                                           
                                                <button class="btn bg-cyan-800 font-medium" type="submit">Enviar</button>
                                                 
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
                <footer class="py-4 bg-black mt-auto">
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
