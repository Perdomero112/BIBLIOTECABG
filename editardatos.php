



<?php
    require_once "../modelo/basededatos.php";
    $obj = new basededatos();
        echo json_encode($obj->editardatos());
?>