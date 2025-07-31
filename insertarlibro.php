


 <?php
    require_once "./librerias.php";
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insertar libros</title>
</head>
<body>
    <h2>formulario de registro</h2>
    <label for="">Nombre del libro</label>
    <input type="text" id="nombre_libro">
    <br>
    <label for="">autor</label>
    <input type="text" id="autor">
    <br>
    <label for="">cantidad</label>
    <input type="number" name="" id="disponible" >
    <br>
    <button onclick="registrolibro()">Registrar libro</button>
</body>
</html>
<script>
    function registrolibro(){
            cadena = "form1=" + $('#nombre_libro').val()+
                    "&form2=" + $('#autor').val()+
                    "&form3=" + $('#disponible').val();
                    $.ajax({
                        type:"POST",
                        url:"../controlador/registrolibros.php",
                        data:cadena,
                        success:function(r){
                            if(r == 1){
                                alert("registro exitoso en base de datos");
                            }else if(r == 2){
                                alert("ups, hubo un problema");
                            }
                        }
                    })
    }
</script>