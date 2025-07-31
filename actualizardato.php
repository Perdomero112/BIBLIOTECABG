



<?php
    require_once "../modelo/basededatos.php";
    $obj = new basededatos();
        $result=$obj->actualizardato();
        echo $result;
?>