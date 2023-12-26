<?php 
    include("cabecera.php");
    include("conexion.php");
    
    $Objconexion = new Conexion();
    $proyectos = $Objconexion->consultar("SELECT * FROM `proyectos`");
?>

<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Bienvenidos</h1>
        <p class="lead">Este es un portafolio privado</p>
        <hr class="my-2">
        <p>Más información</p>
       
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach($proyectos as $proyecto){ ?>
                    <div class="col">
                        <div class="card h-100">
                        <img width="110" class="card-img-top" src="imagenes/<?php echo $proyecto['imagen'];?>" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $proyecto['nombre'];?></h5>
                                <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
</div>

<?php include("pie.php"); ?>
