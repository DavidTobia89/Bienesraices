<?php

//Base de Datos
require 'includes/config/database.php';

$db = conectarDB();
//Arreglo con mensajes de errores
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ;
  $password = mysqli_real_escape_string($db, $_POST['password']) ; ;

if(empty($email)){
    $errores [] = "Debes añadir un E-Mail";
}
if(!$password){
    $errores [] = "Debes añadir un password valido";
}

if(empty($errores)){
    
    $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
    
    $resultado = mysqli_query($db,$query);
    
    if($resultado->num_rows){
        $usuario = mysqli_fetch_assoc($resultado);
        //Verificar si el password es correcto
        $auth  = password_verify($password,  $usuario['password']);
        
        if ($auth){
            session_start();
            $_SESSION ['usuario'] = $usuario['email'];
            $_SESSION ['login']= true;
            header("Location: /bienesraices/admin/index.php");
        }else {
            $errores [] = "El usuario o el password no existe";
        }
    }else {
    $errores [] = "El usuario  no existe";
    }
}
}
require 'includes/funciones.php';

incluirTemplate('header');

?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php foreach($errores as $error):?>
            <div class="alerta error">
            <?php echo $error ;?>
            </div>
        <?php endforeach;?>
        <form  method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email" placeholder="E-mail" require>
                    <label for="password">Password: </label>
                    <input id="password" name="password" type="password" placeholder="Password " require>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
                
        </form>
    </main>
    <?php

incluirTemplate('footer');

?>