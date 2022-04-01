<h1 class="nombre-pagina"><?php echo $titulo;?></h1>
<p class="descripcion-pagina">Ingresa tus datos y crea una cuenta</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="/crear" method="POST" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input 
            type="text"
            name="nombre"
            id="nombre"
            placeholder="Tu Nombre"
            value="<?php echo $usuario->nombre?>"
        >
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input 
            type="text"
            name="apellido"
            id="Aapellido"
            placeholder="Tu Apellido"
            value="<?php echo $usuario->apellido?>"
        >
    </div>
    <div class="campo">
        <label for="correo">Correo:</label>
        <input 
            type="email"
            name="correo"
            id="correo"
            placeholder="Tu Correo"
            value="<?php echo $usuario->correo?>"
        >
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            name="password"
            id="password"
            placeholder="Tu Password"
        >
    </div>
    <div class="campo">
        <label for="password2">Repite tu Password:</label>
        <input 
            type="password"
            name="password2"
            id="password2"
            placeholder="Repite tu Password"
        >
    </div>

    <input type="submit" class="boton-azul" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/">Inicia Sesion</a>
    <a href="/olvide">Reestablece tu Password</a>
</div>