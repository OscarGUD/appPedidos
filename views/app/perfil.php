<h1 class="nombre-pagina"><?php echo $titulo?></h1>
<p class="descripcion-pagina">Edita tu correo o tu nombre</p>



<div class="contenedor">
    <div class="nav">
        <a href="/direccion" class="boton-verde-flex">Direcciones</a>
        <a href="/app" class="boton-verde-flex">Realizar Pedido</a>
    </div>

    <a href="/cambiar-password" class="enlace">Cambiar Password</a>

    <?php include_once __DIR__ . '/../templates/alertas.php';?>

    <form action="/perfil" class="formulario" method="POST">
        <div class="campo">
            <label for="correo">Correo:</label>
            <input 
                type="email"
                placeholder="Tu correo"
                name="correo"
                id="correo"
                value="<?php echo $usuario->correo?>"
            >
        </div>

        <input type="submit" class="boton-azul" value="Guardar Cambios">
    </form>
</div>