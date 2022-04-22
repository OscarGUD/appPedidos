<h1 class="nombre-pagina"><?php echo $titulo?></h1>
<p class="nombre-pagina">Ingresa tu nuevo password</p>

<div class="contenedor">
    <div class="nav">
        <a href="/direccion" class="boton-verde-flex">Direcciones</a>
        <a href="/app" class="boton-verde-flex">Realizar Pedido</a>
    </div>


    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <a href="/perfil" class="enlace">Volver a perfil</a>

    <form action="/cambiar-password" method="POST" class="formulario">
        <div class="campo">
            <label for="actual">Password actual</label>
            <input 
                type="password"
                name="password_actual"
                placeholder="Tu Password actual"
                id="actual"
            >
        </div>
        <div class="campo">
            <label for="nuevo">Password Nuevo</label>
            <input 
                type="password"
                name="password_nuevo"
                id="nuevo"
                placeholder="Tu Nuevo Password"
            >
        </div>
        <input type="submit" value="Guardar Cambios" class="boton-azul">
    </form>
</div>