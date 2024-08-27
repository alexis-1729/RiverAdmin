
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                       <form method="post"  action="<?php echo base_url()?>rios/insertar"
                       autocomplete="off">

                       <div class="form-group"> 
                            <div class="row mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="nombre">Nombre del Rio</label>
                                        <input class="form-control" id="nombre" name="monitoreo_nombre" type="text"
                                        autofocus require>
                                    </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                    <select class="form-select" aria-label="Latitud y Longitud" name="est_id">
                                        <option selected  disabled>Estado</option>
                                        <?php  foreach($datose as $dato) {?>
                                                    <option value="<?php echo $dato['estado_id'];?>"><?php echo $dato ['estado_nombre'];?></option> 
                                        <?php }?>
                                    </select>
                                    </div>   
                                    <div class="col-12 col-sm-6">
                                    <select class="form-select" aria-label="Latitud y Longitud" name="riverubi_id">
                                        <option selected  disabled>Latitud y longitud</option>
                                        <?php  foreach($datosr as $dato) {?>
                                                    <option value="<?php echo $dato['ubi_id'];?>"><?php echo $dato ['ubi_latitud'],' ',$dato ['ubi_longitud'];?></option> 
                                        <?php }?>
                                    </select>
                                    </div>
                            </div>    
                            
                            
                           

                       </div>
                       <a href="<?php echo base_url()?>rios" class="btn btn-primary">Regresar</a>
                       <button type="submit" class="btn btn-success">Guardar</button>
                       </form>
                        
                      
                    
                    </div>
                </main>