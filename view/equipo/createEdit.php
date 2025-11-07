<?php
    $method = "post";
    if ($edit) {
        $method = "put";
    }

    if (isset($_POST["name"], $_POST["country"], $_POST["city"])) { //stuff missing to check for post
        $equipo = new Equipo($_POST["name"], $_POST["country"], $_POST["city"]);
        EquipoDAO::saveEquipo($equipo);
    }
?>
<form action="" method="<?=$method?>">
    <label for="name">Nombre:</label><br>
    <input type="text" id="name" name="name" placeholder="name"><br><br>
    <label for="country">Pais:</label><br>
    <input type="text" id="country" name="country" placeholder="country"><br><br>
    <label for="city">Ciudad:</label><br>
    <input type="text" id="city" name="city" placeholder="city"><br><br>
    <button type="submit">Guardar</button>
    <button type="reset">Reset</button>
</form>