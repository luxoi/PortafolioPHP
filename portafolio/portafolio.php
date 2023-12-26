<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php 

if($_POST){
   

    $nombre = $_POST['nombre'];

    $fecha= new DateTime();
    $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];
    
  

    $imagen_temporal=$_FILES['archivo']['tmp_name'];

    move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

    $descripcion = $_POST['descripcion'];

    $Objconexion = new Conexion();
    $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion'); ";
    
    $Objconexion->ejecutar($sql);
    header("location:portafolio.php");
}

$Objconexion = new Conexion();
$proyectos= $Objconexion->consultar("SELECT * FROM `proyectos`");

if ($_GET && isset($_GET['borrar'])) {
    $id = $_GET['borrar'];
    $Objconexion = new Conexion();

    // Obtener la imagen asociada al proyecto
    $imagen = $Objconexion->consultar("SELECT imagen FROM `proyectos` WHERE id = $id");

    if (!empty($imagen) && isset($imagen[0]['imagen'])) {
        // Eliminar la imagen del directorio
        unlink("imagenes/" . $imagen[0]['imagen']);
    }

    // Eliminar el proyecto de la base de datos
    $sql = "DELETE FROM proyectos WHERE `id` = $id";
    $Objconexion->ejecutar($sql);
    
    // Redirigir a la página después de eliminar
    header("Location: portafolio.php");
    exit(); // Asegurar que el script se detenga después de la redirección
}

?>    

<br/>
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <form action="portafolio.php" method="POST" enctype="multipart/form-data">
                        Nombre del proyecto:<br/>
                        <input type="text" Required class="form-control" name="nombre" id="">
                        imagen del proyecto:<br/>
                        <input type="file" Required class="form-control" name="archivo" id="">
                        Descripcion:
                        <textarea name="descripcion"  Required id="" cols="30" rows="10" class="form-control">

                        </textarea>
                        <input type="submit" value="Enviar proyecto">
                    </form>
                </div>
            </div> 
        </div>

        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($proyectos as $proyecto){ ?>
                        <tr>
                            <td> <?php echo $proyecto['id']; ?> </td>
                            <td> <?php echo $proyecto['nombre']; ?> </td>
                            <td> 
                              <img width="110" src="imagenes/<?php echo $proyecto['imagen'];?>" alt="">
                            </td>
                            <td> <?php echo $proyecto['descripcion']; ?> </td>
                            <td> <a href="?borrar=<?php echo $proyecto['id']; ?>" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include("pie.php"); ?>
