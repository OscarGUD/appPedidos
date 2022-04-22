<h1 class="nombre-pagina"><?php echo $titulo;?></h1>
<p class="descripcion-pagina">Ingresa tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="/" method="POST" class="fomulario">
    <div class="campo">
        <label for="usuario">Email:</label>
        <input 
            type="email"
            name="correo"
            placeholder="Tu email"
            id="usuario"
        >
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            name="password"
            placeholder="Tu password"
            id="password"
        >
    </div>

    <input type="submit" class="boton-azul" value="Iniciar Sesion">
 
</form>

<div class="acciones">
    <a href="/crear">Crea una Cuenta</a>
    <a href="/olvide">Olvide mi Password</a>
</div>