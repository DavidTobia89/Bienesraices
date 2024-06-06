<?php
require '../../includes/funciones.php';
$auth= estaAutenticado();

if(!$auth){
    header("Location: /index.php");
      
}
$id = $_GET['id']; // Usar corchetes en lugar de paréntesis
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header("Location: /bienesraices/admin/index.php");
}
//Base de Datos
require '../../includes/config/database.php';

$db = conectarDB();
//Consultar para obtener los propiedades
$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$titulo = $propiedad['titulo'];
$precio =$propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones =$propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId =$propiedad['vendedorID'];
$imagenPropiedad = $propiedad['imagen'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Conectar a la base de datos (asumiendo que $db es tu conexión)
    
    $titulo = htmlspecialchars(trim($_POST['titulo']), ENT_QUOTES, 'UTF-8');
    $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
    $habitaciones = filter_var($_POST['habitaciones'], FILTER_SANITIZE_NUMBER_INT);
    $wc = filter_var($_POST['wc'], FILTER_SANITIZE_NUMBER_INT);
    $estacionamiento = filter_var($_POST['estacionamiento'], FILTER_SANITIZE_NUMBER_INT);
    $vendedorId = filter_var($_POST['vendedor'], FILTER_SANITIZE_NUMBER_INT);
    $creado = date('Y-m-d'); // Usar el formato correcto de fecha
    $imagen = $_FILES['imagen'];
    // Validar los datos del formulario
    $errores = [];

    if(empty($titulo)){
        $errores [] = "Debes añadir un titulo";
    }
    if(!$precio){
        $errores [] = "Debes añadir un precio";
    }
    if(strlen($descripcion)< 50){
        $errores [] = "Debes añadir un descripcio y debe tener 50 caracteres";
    }
    if(!$habitaciones){
        $errores [] = "Debes añadir un habitaciones";
    }
    if(!$wc){
        $errores [] = "Debes añadir un wc";
    }
    if(!$estacionamiento){
        $errores [] = "Debes añadir un estacionamiento";
    }
    if(!$vendedorId){
        $errores [] = "Debes añadir un vendedor";
    }
   $nombreImagen = '';
     //validar por tamaño
     $medida= 1000 * 1000;
    
     if($imagen['size'] > $medida){
         $errores [] = "La imagen es muy pesada";
     }
    
    if(empty($errores)){
        $imagen = $_FILES['imagen'];
        $carpetaImagenes = __DIR__ . '/../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0777, true);
        }
        if($imagen['name'] ){
            unlink($carpetaImagenes . $propiedad['imagen']);
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }
        
        // Actualizar en la base de datos
        $stmt = $db->prepare("UPDATE propiedades SET titulo = ?, precio = ?, imagen = ?, descripcion = ?, habitaciones = ?, wc = ?, estacionamiento = ?, creado = ?, vendedorId = ? WHERE id = ?");
        $stmt->bind_param("ssssiiissi", $titulo, $precio, $nombreImagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorId, $id);
        $stmt->execute();
        

        if($stmt->affected_rows > 0){
            // Redireccionar al usuario
            header("Location: /bienesraices/admin/index.php?resultado=2");
           
        } else {
            $errores[] = "Error al insertar en la base de datos";
        }
    }
}

incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error):?>
            <div class="alerta error">
            <?php echo $error ;?>
            </div>
            <?php endforeach;?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Informacion General</legend>
                    <label for="titulo">Título:</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">
                    <label for="precio">Precio: </label>
                    <input id="precio" name="precio" type="number" placeholder="Precio " value="<?php echo $precio; ?>">
                    <label for="imagen">Imagen:</label>
                    <input id="imagen"  type="file" accept="image/jpg, image/pnp" name="imagen">
                    <img src="../../imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen Propiedad" class="imagen-small">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" ><?php echo $descripcion; ?></textarea>
                </fieldset>
                <fieldset>
                    <legend>Informacion sobre la Propiedad</legend>
                    <label for="habitaciones">Habitaciones:</label>
                    <input id="habitaciones" name="habitaciones" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
                    <label for="wc">Baños:</label>
                    <input id="wc" type="number" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">
                    <label for="estacionamiento">Estacionamiento:</label>
                    <input id="estacionamiento" name="estacionamiento" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
                   
                </fieldset>
                <fieldset>
                    <legend>Vendedor</legend>
                    
                    
                   <select name="vendedor">
                    <option value="" disabled selected>--Seleccione</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado) ): ?>
                    <option <?php echo  $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo  $vendedor['id']; ?>"><?php echo  $vendedor['nombre'] . " " . $vendedor['apellido'];?></option>
                   
                    <?php endwhile ?>
                    
                   </select> 
                    
                </fieldset>
                <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
                </form>
    </main>
    <?php

incluirTemplate('footer');

?>
