<?php
include("conexion.php");  
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if($_POST['nuevapass'] === $_POST['confirmarpass']){
        $contraseña = mysqli_real_escape_string($conexion,$_POST['nuevapass']);
        $password_nuevo = sha1($contraseña); 

        $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
        $token = mysqli_real_escape_string($conexion,$_POST['token']);

        $sql = "UPDATE usuarios SET password = '$password_nuevo', Token = '$token' WHERE Correo= '$correo' ";
        $resultado = $conexion->query($sql);

        if($resultado > 0 ){
            echo "<script>
                    alert('Tu contraseña ha sido actualizada');
                    window.location = 'login.php';
                    </script>";
                    exit();
        }else{
            echo "<script>
            alert('Las contraseñas que ingresaste no coinciden');
            window.location = 'login.php';
            </script>";
            exit();
        }
    }    
}
?>