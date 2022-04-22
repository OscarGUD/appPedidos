<h1 class="nombre-pagina"><?php echo $titulo;?></h1>
<p class="descripcion-pagina">Rella los datos para guardar tu direccion</p>

<?php include_once __DIR__ . '/../templates/barra.php';?>

<div class="nav">
    <a href="/perfil" class="boton-verde-flex">Perfil</a>
    <a href="/app" class="boton-verde-flex">Realizar Pedido</a>
</div>

<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/alertas.php'?>


    <?php if($mostrar){?>
        <form action="/direccion" method="POST" class="formulario">
        
            <?php include_once __DIR__ . '/../templates/form-direccion.php'?>

            <input type="submit" value="Guardar" class="boton-azul">
        </form>
    <?php }?>

    <?php if(!$mostrar) {?>
        <div class="direcciones" id="direcciones"></div>
    <?php }?>
</div>

<?php 
    $script = '<script src="build/js/domicilio.js"></script>'
?>
