<h1 class="nombre-pagina"><?php echo $titulo?></h1>
<p class="descripcion-pagina">Rellena el formulario y coloca tus datos</p>

<?php include_once __DIR__ . '/../templates/barra.php'?>

<nav class="nav">
    <a class="boton-verde-flex" href="/perfil">Perfil</a>
    <a class="boton-verde-flex" href="/direccion">Direcciones</a>
</nav>

<div id="app" class="contenedor">
    <nav class="tabs">
        <button type="button" data-paso="1" >Servicios</button>
        <button type="button" data-paso="2" >Informacion y Cita</button>
        <button type="button" data-paso="3" >Resumen</button>
    </nav>
    
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div class="listado-servicios" id="servicios"></div>

        <form class="formulario buscador" id="busqueda">
            <div class="campo">
                <input 
                    type="text"
                    placeholder="Buscas algo en especial?"
                    name="busqueda"
                    id="busqueda"
                >
                <button class="boton-azul buscador"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>

        <div id="servicios" class="servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Pedido</h2>
        <p class="text-center">Coloca tus datos para el envio</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text"
                    placeholder="Tu nombe"
                    value="<?php echo $nombre .' '. $apellido;?>"
                    disabled
                >
            </div>
            <div class="campo">
                <label for="domicilio">Domicilio:</label>
                <select name="domicilio" id="domicilio">
                    <option disabled selected>--Selecciona tu domicilio--</option>
                </select>
        </form>
    </div>
</div>


<div class="paginacion">
    <button 
    class="boton-azul"
    id="atras"
    >&laquo; Atras</button>
    <button 
    class="boton-azul" 
    d="siguiente">Siguiente &raquo;</button>
</div>

    <?php $script = '
        <script src="build/js/app.js"></script>
        <script src="https://kit.fontawesome.com/4ed66fff64.js" crossorigin="anonymous"></script>
    '?>
