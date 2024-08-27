
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

                                
                                <div><a href="<?php echo base_url();?>registro/nuevo" class="btn btn-success ms-3"><i class="fa-solid fa-user-plus"></i></a>
                                Agregar User</div>

                                <div><a href="<?php echo base_url();?>registro/eliminados" class="btn btn-warning ms-3"><i class="fa-solid fa-user-xmark"></i></a>
                                Usuario Eliminados</div>
                            
                                    
                            </div>
                            <div class="card-body">
                              
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Cuenta</th>
                                            <th>Estado</th>
                                            <th>Rio</th>
                                            <th>Celular</th>
                                            <th>Editar</th>
                                            <th>Elimnar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- conexion baseda -->
                                      <?php  foreach($datos as $dato) {?>
                                                <tr>
                                                    <td><?php echo $dato ['user_id'];?></td>
                                                    <td><?php echo $dato ['user_nombre'],' ', $dato ['user_apellido'];?></td>
                                                    <td><?php echo $dato ['user_usuario'];?></td>
                                                    <td><?php echo $dato ['user_email'];?></td>
                                                    <td><?php if( $dato ['cuenta_id'] == 1){echo 'Admin';}else echo"Civil"?></td>
                                                    <td><?php echo $dato ['estado_nombre'];?></td>
                                                    <td><?php echo $dato ['monitoreo_nombre'];?></td>
                                                    <td><?php echo $dato ['user_cel'];?></td>

                                                    <td><a href="<?php echo base_url().'/registro/editar/'. $dato['user_id'];?>" class="btn btn-info">
                                                        <i class="fa-solid fa-pen-to-square"></i></a></td>

                                                      <td><a href='#' data-href="<?php echo base_url(). 'registro/eliminar/'. $dato['user_id'];?>" data-toggle="modal" 
                                                        data-target= "#modal-confirma"  title = "Eliminar Usuario" data-placement="top" class="btn btn-warning">
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
               

<!-- Modal -->
<div  id= "modal-confirma" class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Eliminar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Deseas eliminar el usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss= "modal" >No</button>
        <a  class="btn btn-primary btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>