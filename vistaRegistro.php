<!-- nombre, apellidos, email, contraseña, dni, localidad, provincia, cp -->

<?php
include_once "header.php";
include_once "controlador/controladorRegistro.php";
?>

<form id = "vistaRegistro"
    action = "vistaRegistro.php"
    method = "post"
>

<fieldset> 
    <legend align = "left">
        Datos de usuario
    </legend>

    E-mail: <input name = "email" id = "email" type = "email" required><br>
    Contraseña: <input name = "password" id = "password" type = "password" required><br>
    Repetir contraseña: <input name = "password2" id = "password2" type = "password" required><br>
</fieldset><br>


<fieldset>
    <legend align = "left">
        Datos personales
    </legend>

    Nombre: <input name = "nombre" id = "nombre" type = "text" required> <br>
    Apellidos: <input name = "apellidos" id = "apellidos" type = "text" required><br>
    DNI: <input name = "dni" id = "dni" type = "text" pattern = "^[0-9]{8}[A-Z]" placeholder = "12345678X" title = "Ocho dígitos y una letra mayúscula" required><br>
    Fecha de nacimiento: <input name = "nacimiento" id = "nacimiento" type = "date"><br>
    Localidad: <input name = "localidad" id = "localidad" type = "text" required><br>
    Provincia: <input name = "provincia" id = "provincia" type = " text" required><br>
    CP: <input name = "cp" id = "cp" type = "number" pattern = "^[0-9]{5}" required><br>
    Dirección: <input name = "direccion" id = "direccion" type = "text" required><br>
    Teléfono: <input name = "telefono" id = "telefono" type = "tel" pattern = "[0-9]{9}"><br>
</fieldset>

<input name = "Registrarse" id = "submit1" type = "submit" value = "Registrarse">

</form>
