<h1 class="nombre-pagina"><?php echo $titulo?></h1>
<p class="descripcion-pagina">Modifique la direccion</p>

<a href="/direccion" class="enlace">Regresar a Direcciones</a>

<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/alertas.php';?>

    <form action="/editar-direccion" class="formulario" method="POST">
        <?php if($mostrar) {?>
            <?php include_once __DIR__ . '/../templates/form-direccion.php';?>
            <input type="submit" class="boton-azul" value="Guardar Cambios">
        <?php }?>    
    </form>
</div>