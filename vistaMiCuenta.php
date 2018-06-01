
<?php
include_once "header.php";
include_once "controlador/controladorMicuenta.php";
?>

<form id = "vistaMiCuenta"
    action = "vistaMiCuenta.php"
    method = "post"
>

<fieldset> 
    <legend align = "left">
        Datos de usuario
    </legend>

    E-mail: <input name = "email" id = "email" type = "email" value = "<?php echo $email  ?>" disabled><br>
    Contraseña actual: <input name = "password" id = "password" type = "password"><br>
    Nueva contraseña: <input name = "password-nueva" id = "password-nueva" type = "password"><br>
</fieldset><br>


<fieldset>
    <legend align = "left">
        Datos personales
    </legend>

    Nombre: <input name = "nombre" id = "nombre" type = "text" value = "<?php echo $nombre ?>" required> <br>
    Apellidos: <input name = "apellidos" id = "apellidos" type = "text" value = "<?php echo $apellidos ?>" required><br>
    DNI: <input name = "dni" id = "dni" type = "text" pattern = "^[0-9]{8}[A-Z]" value = "<?php echo $dni ?>" title = "Ocho dígitos y una letra mayúscula" required><br>
    Localidad: <input name = "localidad" id = "localidad" type = "text" value = "<?php echo $localidad ?>" required><br>
    Provincia: <input name = "provincia" id = "provincia" type = "text" value = "<?php echo $provincia ?>" required><br>
    CP: <input name = "cp" id = "cp" type = "number" pattern = "^[0-9]{5}" value = "<?php echo $cp ?>" required><br>
    Dirección: <input name = "direccion" id = "direccion" type = "text" value = "<?php echo $direccion ?>" required><br>
    Teléfono: <input name = "telefono" id = "telefono" type = "tel" pattern = "[0-9]{9}" value = "<?php echo $telefono ?>" ><br>
</fieldset>

<input name = "Cambiardatos" id = "submit1" type = "submit" value = "Modificar datos">

</form>