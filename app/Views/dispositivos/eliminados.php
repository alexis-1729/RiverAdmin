
                <!-- contendo inicio -->
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/">Dispositivos</a></li>
                            <li class="breadcrumb-item active"><?php echo $titulo;?></li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header d-flex ">

                                
                                <div><a href="<?php echo base_url();?>dispositivos/nuevo" class="btn btn-success ms-3"><i class="fa-solid fa-user-plus"></i></a>
                                Agregar Dispositivo</div>

                                <div><a href="<?php echo base_url();?>dispositivos/eliminados" class="btn btn-warning ms-3"><i class="fa-solid fa-user-xmark"></i></a>
                                Dispositivos Eliminados</div>
                            
                                    
                            </div>
                            <div class="card-body">
                              
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Latitud</th>
                                            <th>Longitud</th>
                                            <th>Rio</th>
                                            <th>Estado</th>
                                            <th>Restaurar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- conexion baseda -->
                                      <?php  foreach($datos as $dato) {?>
                                                <tr>
                                                    <td><?php echo $dato ['circuito_id'];?></td>
                                                    <td><?php echo $dato ['circuito_nombre']?></td>
                                                    <td><?php echo $dato ['ubi_latitud']?></td>
                                                    <td><?php echo $dato ['ubi_longitud']?></td>
                                                    <td><?php echo $dato ['monitoreo_nombre'];?></td>
                                                    <td><?php echo $dato ['estado_nombre'];?></td>
                                             
                                            

                                                    <td>
                                                    <a href="<?php echo base_url().'/dispositivos/restaurar/'. $dato['circuito_id'];?>" class="btn btn-success">
                                                        <i class="fa-solid fa-user-plus"></i></a>
                                                </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- contenidofin -->