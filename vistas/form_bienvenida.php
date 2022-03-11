<?php
include "helper\Utilidades.php";

/**
 * Crea un formulario que se va a utilizar
 * para la creación de un Festival de 
 * musica basandose en estas votaciones,
 * Se tomará el DNI para posteriormente guardarlo 
 * y así evitar repeticiones extra
 */
include "cabecera.php";

//comprueba si la variable validador contiene algo y si hay errores los escribe
if (isset($validador)) {
    $errores = $validador->getErrores();
    if (isset($errores) && !empty($errores)) {
        echo "<div class='uno'>";
            echo "<ul>";
            foreach ($errores as $value) {
                foreach($value as $key => $si){
                echo "<li>" . $si . "</li>";
                }
            }
            echo "</ul>";
        echo "</div>";
    }
}
?>
<form id="form" action="index.php" method="post">

    <div>
        <h1>Encuesta Festival Rakkora</h1>
        <div class='uno'>
            <label>DNI</label>
            <input type="text" name="dni" maxlength="9" value="<?php echo Input::get('dni') ?>" /><br />
            <label>De los siguientes generos musicales, elige los que te gustaria escuchar:</label>
            <div>
                <div class="uno">
                    <input id="Pop" type="checkbox" value="Pop" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Pop")
                                                                                    ?> />
                    <label for="Pop">Pop</label>
                    <input id="Clasica" type="checkbox" value="Clasica" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Clasica")
                                                                                            ?> />
                    <label for="Clasica">Clasica</label>
                    <input id="Rock" type="checkbox" value="Rock" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Rock")
                                                                                    ?> />
                    <label for="Rock">Rock</label>
                    <input id="Latina" type="checkbox" value="Latina" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Latina")
                                                                                        ?> />
                    <label for="Latina">Latina</label>
                    <input id="Reague" type="checkbox" value="Reague" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Reague")
                                                                                        ?> />
                    <label for="Reague">Reague</label>
                    <input id="Kpop" type="checkbox" value="Kpop" name="generos[]" <?php echo Utilidades::verificarCheckbox(Input::get('generos'), "Kpop")
                                                                                    ?> />
                    <label for="Kpop">Kpop</label>
                </div>
            </div>
            <label>De los siguientes cantantes, ¿cuales te gustaria ver?:</label>
            <div>
                <div class="uno">
                    <input id="tay" type="checkbox" value="Taylor Swift" name="cantantes[]" <?php echo Utilidades::verificarCheckbox(Input::get('cantantes'), "Taylor Swift") ?> />
                    <label for="tay">Taylor Swift</label>
                    <input id="katy" type="checkbox" value="Katy Perry" name="cantantes[]" <?php echo Utilidades::verificarCheckbox(Input::get('cantantes'), "Katy Perry") ?> />
                    <label for="katy">Katy Perry</label>
                    <input id="fob" type="checkbox" value="Fall out Boy" name="cantantes[]" <?php echo Utilidades::verificarCheckbox(Input::get('cantantes'), "Fall out Boy") ?> />
                    <label for="fob">Fall out Boy</label>
                    <input id="bts" type="checkbox" value="BTS" name="cantantes[]" <?php echo Utilidades::verificarCheckbox(Input::get('cantantes'), "BTS") ?> />
                    <label for="bts">BTS</label>
                    <input id="rosa" type="checkbox" value="Rosalia" name="cantantes[]" <?php echo Utilidades::verificarCheckbox(Input::get('cantantes'), "Rosalia") ?> />
                    <label for="rosa">Rosalia</label>
                </div>
            </div>
            <div>
                <input type="submit" name="enviar" value="<?php echo $fase ?>" class="boton">
            </div>
</form>
<?php
if (isset($resultado)) {
    echo "<div class='texto' />";
    echo $resultado;
    echo "</div>";
}
    include 'vistas/pie.php';
?>