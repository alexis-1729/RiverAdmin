
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               
                        <?php if(isset($validation)){?>
                            <div class="alert alert-danger">
                           <?php echo $validation ->listErrors();?>
                           </div>
                           <?php } ?> 

                       <form method="post"  action="<?php echo base_url()?>registro/actualizar"
                       autocomplete="off">

                        <input type="hidden" value="<?php echo $datos['user_id']?>" name="user_id">
                       
                       <div class="form-group"> 
                            <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="nombre">Nombre</label>
                                        <input class="form-control" id="nombre" name="user_nombre" type="text" 
                                        value="<?php if($si){
                                            echo set_value('user_nombre');
                                        }else 
                                        echo $datos['user_nombre'];
                                        ?>" autofocus >
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="apellido">Apellido</label>
                                        <input class="form-control" id="apellido" name="user_apellido" type="text" 
                                        value="<?php
                                        if($si){
                                            echo set_value('user_apellido');
                                        }else
                                          echo $datos['user_apellido'];
                                        ?>"
                                         >
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="user_email">Email</label>
                                        <input class="form-control" id="user_email" name="user_email" type="email" 
                                        value="<?php
                                        if($si){
                                            echo set_value('user_email');
                                        }else 
                                        echo $datos['user_email'];?>"
                                        autofocus >
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="user_usuario">Nombre de Usuario</label>
                                        <input class="form-control" id="user_usuario" name="user_usuario" type="text"
                                        value="<?php 
                                        if($si){
                                            echo set_value('user_usuario');
                                        }else
                                        echo $datos['user_usuario'];
                                        ?>"
                                        autofocus require>
                                    </div>
                            </div>
                            <div class="row mb-3">
                                   
                                    <div class="col-12 col-sm-6">
                                        <label for="user_cel">Numero Celular</label>
                                        <input class="form-control" id="user_cel" name="user_cel" type="text" 
                                        value="<?php 
                                        if($si){
                                            echo set_value('user_cel');
                                        }else
                                        echo $datos['user_cel'];
                                        ?>"
                                         require>
                                    </div>
                            </div>

                            <div class="row mb-3">   
                                    <div class="col-12 col-sm-6">
                                    <select class="form-select" aria-label="Rio" name="user_rioid">
                                        <option selected  
                                        value="<?php echo $datos['monitoreo_id'];?>"><?php echo $datos['monitoreo_nombre'];?></option>
                                        <?php  foreach($datosm as $dato) {?>
                                                    <option value="<?php echo $dato['monitoreo_idt'];?>"><?php echo $dato ['monitoreo_nombret'];?></option> 
                                        <?php }?>
                                    </select>
                                    </div>
                            </div>

                            <div class="row mb-3">   
                                    <div class="col-12 col-sm-6">
                                    <select class="form-select" aria-label="Tipo de Cuenta" name="cuenta_id" >
                                    <?php if( $datos['cuenta_id'] == 1){?>
                                        <option selected  value= 1>Admin</option>
                                        <option value= 2>Civil</option>
                                        <?php }else{ ?>
                                            <option selected  value= 2>Civil</option>
                                            <option value= 1>Admin</option>
                                        <?php
                                        } ?>   
                                    </select>
                                    </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                    <select class="form-select" aria-label="Estado" name="est_id">
                                        <option selected  value="<?php echo $datos['estado_id'];?>"><?php echo $datos['estado_nombre'];?></option>
                                        <?php  foreach($datose as $dato) {?>
                                                    <option value="<?php echo $dato['estado_idt'];?>"><?php echo $dato ['estado_nombret'];?></option> 
                                        <?php }?>
                                    </select>
                                    </div>  
                            </div>


                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Password</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" name="user_password" 
                                    
                                </div>
                                <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">
                                    Must be 8-20 characters long.
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="reinputPassword6" class="col-form-label">Confirmar Password</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="reinputPassword6" class="form-control" name='repassword' 
                                    value="<?php set_value('repassword');
                                    ?>">
                                </div>
                                <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">
                                    Must be 8-20 characters long.
                                    </span>
                                </div>
                            </div>

                           
                           

                       </div>
                       <a href="<?php echo base_url()?>/registro" class="btn btn-primary">Regresar</a>
                       <button type="submit" class="btn btn-success">Guardar</button>
                       </form>
                        
                      
                    
                    </div>
                </main>