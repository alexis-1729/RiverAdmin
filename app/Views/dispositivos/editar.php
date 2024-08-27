
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                       <form method="post"  action="<?php echo base_url()?>/dispositivos/actualizar"
                       autocomplete="off">

                       <input type="hidden" value="<?php echo $datosi['circuito_id']?>" name="circuito_id">

                       <div class="form-group"> 
                            <div class="row mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="nombre">Nombre del Circuito</label>
                                        <input class="form-control" id="nombre" name="circuito_nombre" type="text" value="<?php echo $datosi['circuito_nombre']?>"
                                        autofocus require>
                                    </div>
                            </div>

                            <div class="row mb-3">   
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" aria-label="Latitud y Longitud" name="pos_id">
                                            <option selected  value="<?php echo $datosi['ubi_id']?>"><?php echo $datosi ['ubi_latitud'],' ',$datosi ['ubi_longitud'];?></option>
                                            <?php  foreach($datosr as $dato) {?>
                                                    <?php if($dato['ubi_idt'] != $datosi['ubi_id']){?>
                                                    <option value="<?php echo $dato['ubi_idt'];?>"><?php echo $dato ['ubi_latitudt'],' ',$dato ['ubi_longitudt'];?></option> 
                                                    <?php }?>
                                              <?php }?>
                                        </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" aria-label="Rio" name="pmonitoreo_id">
                                            <option selected  value="<?php echo $datosi['monitoreo_id']?>"><?php echo $datosi ['monitoreo_nombre'];?></option>
                                            <?php  foreach($datosm as $dato) {?>
                                                    <?php if($dato['monitoreo_idt'] != $datosi['monitoreo_id']){?>
                                                    <option value="<?php echo $dato['monitoreo_idt'];?>"><?php echo $dato ['monitoreo_nombret'];?></option> 
                                                    <?php }?>
                                              <?php }?>
                                        </select>
                                </div>
                                
                            </div>

                           

                            <div class="row mb-3">
                                <div class="col-12 col-sm-6">
                                        <select class="form-select" aria-label="Estado" name="estado_id">
                                            <option selected value="<?php echo $datosi['estado_id']?>" ><?php echo $datosi ['estado_nombre'];?></option>
                                            <?php  foreach($datose as $dato) {?>
                                                    <?php if($dato['estado_idt'] != $datosi['estado_id']){?>
                                                    <option value="<?php echo $dato['estado_idt'];?>"><?php echo $dato ['estado_nombret'];?></option> 
                                                    <?php }?>
                                              <?php }?>
                                        </select>
                                </div>
                            </div>

                           
                           

                       </div>
                       <a href="<?php echo base_url()?>dispositivos" class="btn btn-primary">Regresar</a>
                       <button type="submit" class="btn btn-success">Guardar</button>
                       </form>
                        
                      
                    
                    </div>
                </main>