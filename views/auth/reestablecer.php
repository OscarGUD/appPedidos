<h1 class="nombre-pagina"><?php echo $titulo?></h1>
<p class="descripcion-pagina">Ingresa tu nuevo password</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form class="formulario" method="POST">
<div class="campo">
<?php if($mostrar){?>
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
<?php }?>

    <input type="submit" class="boton-azul" value="Nuevo Password"> 
</form>
