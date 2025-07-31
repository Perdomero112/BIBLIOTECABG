<?php
    class basededatos {
        //consultar
        //eliminar
        public function eliminardatos(){
            require_once "conexion.php";
            $conexion=conexion();
            $id = $_POST['form1'];
            $borrar = "DELETE FROM libros WHERE id_libro = '$id' ";
            $resultado = mysqli_query($conexion,$borrar);
            if($resultado){ return 1; }else{ return 2; }
        }
        //actualizar
        public function editardatos(){
            require_once "conexion.php";
            $conexion=conexion();
            $id = $_POST['form1'];
            $sql = "SELECT * from libros where id_libro = '$id' ";
            $resultado = mysqli_query($conexion,$sql);
            
            if (!$resultado) {
                return array("error" => "Error en la consulta: " . mysqli_error($conexion));
            }
            
            if (mysqli_num_rows($resultado) == 0) {
                return array("error" => "No se encontró el registro con ID: $id");
            }
            
            $ver=mysqli_fetch_row($resultado);
            $datos=array( "0" => $ver[0],
                          "1" => $ver[1],
                          "2" => $ver[2],
                          "3" => $ver[3]
                        );
            return $datos;
        }
        //agregar
        public function actualizardato(){
            require_once "conexion.php";
            $conexion=conexion();
            $id_libro = $_POST['form1']; //recibiendo los 
            $nombre_libro = $_POST['form2']; // datos
            $autor = $_POST['form3'];
            $disponible = $_POST['form4'];
            

            $agregar = "UPDATE libros SET nombre_libro = '$nombre_libro',
                                                autor = '$autor',
                                                disponible = '$disponible'
                        WHERE id_libro = '$id_libro'";
            $resultado = mysqli_query($conexion,$agregar);
            if($resultado){ return 1; }else{ return 2; }
        }
    }
?>