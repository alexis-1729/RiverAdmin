
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

                                
                                <div><a href="<?php echo base_url();?>estado/nuevo" class="btn btn-success ms-3"><i class="fa-solid fa-user-plus"></i></a>
                                Agregar Estado</div>

                                <div><a href="<?php echo base_url();?>estado/eliminados" class="btn btn-warning ms-3"><i class="fa-solid fa-user-xmark"></i></a>
                                Estados Eliminados</div>
                            
                                    
                            </div>
                            <div class="card-body">
                              
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- conexion baseda -->
                                      <?php  foreach($datos as $dato) {?>
                                                <tr>
                                                    <td><?php echo $dato ['estado_id'];?></td>
                                                    <td><?php echo $dato ['estado_nombre']?></td>
                                                    

                                                    <td><a href="<?php echo base_url().'/estado/editar/'. $dato['estado_id'];?>" class="btn btn-info">
                                                        <i class="fa-solid fa-pen-to-square"></i></a></td>
                                                        <td><a href="<?php echo base_url().'/estado/eliminar/'. $dato['estado_id'];?>" class="btn btn-warning">
                                                        <i class="fa-solid fa-trash-can"></i></a></td>

                                                </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- contenidofin -->