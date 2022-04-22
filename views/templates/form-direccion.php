<div class="campo">
        <label for="colonia">Colonia:</label>
        <input 
            type="text"
            id="colonia"
            name="colonia"
            placeholder="Tu colonia"
            value="<?php echo $domicilio->colonia;?>"
        >
    </div>
    <div class="campo">
        <label for="calle">Calle y Calle de Cruze:</label>
        <input 
            type="text"
            name="calle"
            id="calle"
            placeholder="Ejem: calle y cruza con calle "
            value="<?php echo $domicilio->calle;?>"
        >
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input 
            type="tel"
            id="telefono"
            placeholder="Tu telefono"
            name="telefono"
            value="<?php echo $domicilio->telefono;?>"
        >
    </div>
    <div class="campo">
        <label for="int">Numero int:</label>
        <input 
            type="text"
            id="int"
            name="interior"
            placeholder="tu Numero Interno"
            value="<?php echo $domicilio->interior;?>"
        >
    </div>
    <div class="campo">
        <label for="ext">Numero Exterior:</label>
        <input 
            type="text"
            id="ext"
            name="exterior"
            placeholder="Tu numero exterior"
            value="<?php echo $domicilio->exterior;?>"
        >
    </div>