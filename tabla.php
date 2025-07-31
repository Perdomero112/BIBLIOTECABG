<?php

    require_once "../modelo/conexion.php";
    require_once "./librerias.php";
    $conexion = conexion();

    $sql="SELECT * from libros"; //lectura
    $resultado = mysqli_query($conexion,$sql); //conversion
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>tabla</title>
</head>
<body>
    <h1>INVENTARIO DE LIBROS DISPONIBLES DE LA BIBLIOTECA BRAULIO GONZALEZ</h1>
    

    <table style="border: 1px solid black;">
        <tr  style="border: 1px solid black;">
            <td>id</td>
            <td>nombre del libro</td>
            <td>autor</td>
            <td>disponibles</td>
            
            <td>OPCIONES</td>
        </tr>
        <?php while($ver = mysqli_fetch_row($resultado)): ?>
        <tr>
            <td><?php print($ver[0]); ?></td>
            <td><?php print($ver[1]); ?></td>
            <td><?php print($ver[2]); ?></td>
            <td><?php print($ver[3]); ?></td>
            
            <td><button onclick="eliminardatos('<?php print($ver[0]); ?>')">ELIMINAR</button>
                <button onclick="editardatos('<?php print($ver[0]); ?>')">EDITAR</button>
            </td>
        </tr>
      <?php  endwhile; ?>
    </table>

    <h2>formulario de actualizacion de libros</h2>
    <label for="">ID</label>
    <input type="text" id="id" disabled>
    <br>
    <label for="">Nombre</label>
    <input type="text" id="nombre_libro" placeholder="ingresa el nombre del libro">
    <br>
    <label for="">autor</label>
    <input type="text" id="autor" placeholder="gabriel garcia">
    <br>
    <label for="">disponibles</label>
    <input type="number" name="" id="disponible" >
    <br>
    <button onclick="actualizardato()">actualizardato</button>


    
</body>
</html>

<script>
    function editardatos(id){
                cadena = "form1=" + id;
                 $.ajax({
                    type:"POST",
                    url:"../controlador/editardatos.php",
                    data:cadena,
                    success:function(r){
                        try {
                            dato=jQuery.parseJSON(r);
                            if (dato.error) {
                                alert("Error: " + dato.error);
                            } else {
                                $('#id').val(dato['0']);
                                $('#nombre_libro').val(dato['1']);
                                $('#autor').val(dato['2']);
                                $('#disponible').val(dato['3']);
                            }
                        } catch (e) {
                            alert("Error al procesar la respuesta: " + e.message);
                            console.log("Respuesta del servidor:", r);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Error en la petición: " + error);
                        console.log("Error completo:", xhr.responseText);
                    }
                 })
        }

        function eliminardatos(id){
                cadena = "form1=" + id;
                 $.ajax({
                    type:"POST",
                    url:"../controlador/eliminardatos.php",
                    data:cadena,
                    success:function(r){
                        if(r == 1){
                            alert("eliminado exitoso");
                            location.reload();
                        }else if(r == 2){
                            alert("ups, hubo un problema");
                        }
                    }
                 })
        }
        function actualizardato(){
            cadena = "form1=" + $('#id').val()+
                    "&form2=" + $('#nombre_libro').val()+
                    "&form3=" + $('#autor').val()+
                    "&form4=" + $('#disponible').val();
                    
                    $.ajax({
                        type:"POST",
                        url:"../controlador/actualizardato.php",
                        data:cadena,
                        success:function(r){
                            if(r == 1){
                                alert("actualizacion en base de datos");
                            }else if(r == 2){
                                alert("ups, hubo un problema");
                            }
                        }
                    })
    }
</script>