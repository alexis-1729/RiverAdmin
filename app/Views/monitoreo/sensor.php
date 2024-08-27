
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
                                            <th>Nivel del Agua</th>
                                            <th>Temperatura</th>
                                            <th>Velocidad de corriente</th>
                                            <th>Fecha</th>
                                            <!-- <th>Hora</th>  -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- conexion baseda -->
                                      <?php  foreach($datos as $dato) {?>
                                                <tr>
                                                    <td><?php echo $dato ['sens_id'];?></td>
                                                    <td><?php echo $dato ['sens_nivel']?></td>
                                                    <td><?php echo $dato ['sens_temp']?></td>
                                                    <td><?php echo $dato ['sens_vel']?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($dato['sens_fecha'])); ?></td>
                                                    <!-- <td><?php echo date('H:i:s', strtotime($dato['sens_hora'])); ?></td> -->
                                                </tr>   
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- contenidofin -->