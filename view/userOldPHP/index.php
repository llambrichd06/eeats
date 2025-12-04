<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>PFP</td>
        <td>Password</td>
        <td>Role</td>
        <td>Is Premium?</td>
        <td>Show</td>
    </tr>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?=$user->getId()?></td>
            <td><?=$user->getName()?></td>
            <td><?=$user->getEmail()?></td>
            <td><?=$user->getProfilePicture()?></td>
            <td><?=$user->getPassword()?></td>
            <td><?=$user->getRole()?></td>
            <td><?=$user->getPremium() == 1 ? 'Yes' : 'No'?></td>
            <td><a href="?controller=User&action=show&iduser=<?=$user->getId()?>">show user</a></td>
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

