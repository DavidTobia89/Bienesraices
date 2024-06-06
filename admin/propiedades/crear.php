<?php
require '../../includes/funciones.php';
$auth= estaAutenticado();

if(!$auth){
    header("Location: /index.php");
      
}
//Base de Datos
require '../../includes/config/database.php';
$db = conectarDB();
//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$titulo = '';
$precio ='';
$descripcion = '';
$habitaciones ='';
$wc = '';
$estacionamiento = '';
$vendedorId ='';

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
    if(!$imagen['name'] || $imagen['error']){
        $errores [] = "Debes añadir una imagen";
    }
     //validar por tamaño
     $medida= 1000 * 1000;
    
     if($imagen['size'] > $medida){
         $errores [] = "La imagen es muy pesada";
     }
    
    if(empty($errores)){
        // Subir la imagen
        $carpetaImagenes = __DIR__ . '/../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0777, true);
        }

        $imagen = $_FILES['imagen'];
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        
        // Insertar en la base de datos
        $stmt = $db->prepare("INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiss", $titulo, $precio, $nombreImagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorId);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            // Redireccionar al usuario
            header("Location: /bienesraices/admin/index.php?resultado=1");
           
        } else {
            $errores[] = "Error al insertar en la base de datos";
        }
    }
}


incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error):?>
            <div class="alerta error">
            <?php echo $error ;?>
            </div>
            <?php endforeach;?>
        <form action="/bienesraices/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Informacion General</legend>
                    <label for="titulo">Título:</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">
                    <label for="precio">Precio: </label>
                    <input id="precio" name="precio" type="number" placeholder="Precio " value="<?php echo $precio; ?>">
                    <label for="imagen">Imagen:</label>
                    <input id="imagen"  type="file" accept="image/jpg, image/pnp" name="imagen">
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
                <input type="submit" value="Crear Propiedad" class="boton boton-verde">
                </form>
    </main>
    <?php

incluirTemplate('footer');

?>
