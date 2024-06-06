<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../includes/funciones.php';
$auth= estaAutenticado();

if(!$auth){
    header("Location: /index.php");
      
}
//Base de Datos
require '../includes/config/database.php';
$db = conectarDB();

$querry="SELECT * FROM propiedades";

$resultadoConsulta =mysqli_query($db,$querry);

$resultado = $_GET ['resultado']?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id=$_POST['id'];
    $id= filter_var( $id, FILTER_VALIDATE_INT);
    if($id){
        //Elimina el archivo
        $querry = "SELECT imagen FROM propiedades WHERE id ={$id}";
        $resultado =mysqli_query($db,$querry);
        $propiedad = mysqli_fetch_assoc( $resultado);
        unlink('../imagenes/' . $propiedad['imagen']);
        //Elimina la propiedad
        $querry = "DELETE FROM propiedades WHERE id ={$id}";
        $resultado =mysqli_query($db,$querry);
        if($resultado){
            header("Location: /bienesraices/admin/index.php?resultado=3");
        }
    }
}


incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if (intval ($resultado) === 1):?>
            <p class="alerta exito"> Anuncio creado correctamente</p>
        <?php elseif (intval ($resultado) === 2):?>
            <p class="alerta exito"> Anuncio actualizado correctamente</p>
        <?php elseif (intval ($resultado) === 3):?>
            <p class="alerta exito"> Anuncio eliminado correctamente</p>
        
        <?php endif?>
            
        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
            <table class="propiedades">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Título</td>
                        <td>Imagen</td>
                        <td>Precio</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):?>
                        <tr>
                            <td><?php echo $propiedad['id'];?></td>
                            <td><?php echo $propiedad['titulo'];?></td>
                            <td><img src="../imagenes/<?php echo $propiedad['imagen'];?>" alt="imagen tabla" class="imagen-tabla"></td>
                            <td>$<?php echo $propiedad['precio'];?></td>
                            <td>
                                <form method="POST" class="w-100">
                                    <input type="hidden" name="id" value="<?php echo $propiedad['id'];?>">
                                    <input type="submit" class="boton-rojo-block" value="Eliminar">
                                
                                </form>
                            <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block">Actualizar</a>
                            </td>
                        </tr>
                    <?php endwhile?>
                </tbody>
            </table>
    </main>
    <?php
mysqli_close($db);
incluirTemplate('footer');

?>