<h1 class="nombre-pagina"><?php echo $titulo;?></h1>
<p class="descripcion-pagina">Ingresa tus correo para reestablecer tu password</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="correo">Correo:</label>
        <input 
            type="email"
            name="correo"
            id="correo"
            placeholder="Tu Correo"
        >
    </div>

    <input type="submit" class="boton-azul" value="Enviar Correo">
</form>

<div class="acciones">
    <a href="/">Inicia Sesion</a>
    <a href="/crear">Crea una Cuenta</a>
</div>