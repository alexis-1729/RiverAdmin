
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                       <form method="post"  action="<?php echo base_url()?>/rios/actualizar"
                       autocomplete="off">

                       <input type="hidden" value="<?php echo $datosi['monitoreo_id']?>" name="monitoreo_id">

                       <div class="form-group"> 
                            <div class="row mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="nombre">Nombre del Rio</label>
                                        <input class="form-control" id="nombre" name="monitoreo_nombre" type="text" value="<?php echo $datosi['monitoreo_nombre']?>"
                                        autofocus require>
                                    </div>
                            </div>

                            <div class="row mb-3">   
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" aria-label="Latitud y Longitud" name="riverubi_id">
                                            <option selected  value="<?php echo $datosi['riverubi_id']?>"><?php echo $datosi ['ubi_latitud'],' ',$datosi ['ubi_longitud'];?></option>
                                            <?php  foreach($datosr as $dato) {?>
                                                    <?php if($dato['ubi_idt'] != $datosi['riverubi_id']){?>
                                                    <option value="<?php echo $dato['ubi_idt'];?>"><?php echo $dato ['ubi_latitudt'],' ',$dato ['ubi_longitudt'];?></option> 
                                                    <?php }?>
                                              <?php }?>
                                        </select>
                                </div>
                            </div>  
                            <div class="row mb-3">   
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" aria-label="Estado" name="est_id">
                                            <option selected  value="<?php echo $datosi['est_id']?>"><?php echo $datosi ['estado_nombre'];?></option>
                                            <?php  foreach($datose as $dato) {?>
                                                    <?php if($dato['estado_idt'] != $datosi['est_id']){?>
                                                    <option value="<?php echo $dato['estado_idt'];?>"><?php echo $dato ['estado_nombret']?></option> 
                                                    <?php }?>
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