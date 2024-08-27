
               <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                       <form method="post"  action="<?php echo base_url()?>/estado/insertar"
                       autocomplete="off">

                       <div class="form-group"> 
                            <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="nombre">Estado</label>
                                        <input class="form-control" id="nombre" name="estado_nombre" type="text"
                                        autofocus require>
                                    </div>
                            </div>
                           
                           

                       </div>
                       <a href="<?php echo base_url()?>/estado" class="btn btn-primary">Regresar</a>
                       <button type="submit" class="btn btn-success">Guardar</button>
                       </form>
                        
                      
                    
                    </div>
                </main>