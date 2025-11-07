<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Profile Picture file name</td>
        <td>Password</td>
        <td>Show</td>
    </tr>
    <?php foreach ($equipos as $equipo) { ?>
        <tr>
            <td><?=$equipo->getId()?></td>
            <td><?=$equipo->getName()?></td>
            <td><?=$equipo->getProfilePicture()?></td>
            <td><?=$equipo->getPassword()?></td>
            <td><a href="?controller=Equipo&action=show&idequipo=<?=$equipo->getId()?>">mostrar equipo</a></td>
        </tr>
    <?php } ?>
    
</table>
    <!-- foreach ($equipos as $key => $equipo) {
        $id = $equipo->getId();
        $nombre = $equipo->getNombre();
        $ciudad = $equipo->getCiudad();
        $pais = $equipo->getPais();
        echo "equipo num ".($key+1)." Nombre: $nombre, Ciudad: $ciudad, Pais: $pais<br>";
    } -->

