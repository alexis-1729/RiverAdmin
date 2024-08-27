
                <!-- contendo inicio -->
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $titulo;?></h1>
               

                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/">Registro</a></li>
                            <li class="breadcrumb-item active"><?php echo $titulo;?></li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header d-flex ">

                                    
                            </div>
                            <div class="card-body">
                              
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Rio</th>
                                            <th>Estado</th>
                                            <th>Longitud</th>
                                            <th>Latitud</th>
                                            <th>Puntos de Monitoreo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- conexion baseda -->
                                      <?php  foreach($datos as $dato) {?>
                                                <tr>
                                                    <td><?php echo $dato ['monitoreo_id'];?></td>
                                                    <td><?php echo $dato ['monitoreo_nombre']?></td>
                                                    <td><?php echo $dato ['estado_nombre']?></td>
                                                    <td><?php echo $dato ['ubi_longitud']?></td>
                                                    <td><?php echo $dato ['ubi_latitud']?></td>
                                                    
                                                    <td><a href="<?php echo base_url().'monitoreo/observar/'. $dato['monitoreo_id'];?>" class="btn btn-info">
                                                    <i class="fa-solid fa-binoculars"></i></a></td>
                                                   

                                                </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- contenidofin -->