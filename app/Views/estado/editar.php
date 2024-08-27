
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                       <form method="post"  action="<?php echo base_url()?>/estado/actualizar"
                       autocomplete="off">

                        <input type="hidden" value="<?php echo $datos['estado_id']?>" name="estado_id">

                       <div class="form-group"> 
                            
                            <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                        <label for="estado_id">Estado</label>
                                        <input class="form-control" id="estado_id" name="estado_nombre" type="text" value="<?php echo $datos['estado_nombre'];?>"
                                        autofocus require>
                                    </div>
                            </div>
                            

                           
                           

                       </div>
                       <a href="<?php echo base_url()?>/estado" class="btn btn-primary">Regresar</a>
                       <button type="submit" class="btn btn-success">Guardar</button>
                       </form>
                        
                      
                    
                    </div>
                </main>