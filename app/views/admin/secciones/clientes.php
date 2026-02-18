<?php
session_start();

if (!isset($_SESSION['rol']) || 
   ($_SESSION['rol'] != 'recepcionista' && $_SESSION['rol'] != 'jefe')) {
    header("Location: ../../../public/login.php");
    exit();
}
?>

<h2>CRUD Usuarios</h2>

<button onclick="abrirFormulario()">Nuevo Usuario</button>

<div id="formulario" style="display:none;">
    <input type="hidden" id="id">

    <input type="text" id="nombre" placeholder="Nombre">
    <input type="email" id="gmail" placeholder="Correo">
    <input type="password" id="password" placeholder="Password">

    <select id="rol">
        <option value="cliente">Cliente</option>
        <option value="recepcionista">Recepcionista</option>
        <option value="jefe">Jefe</option>
    </select>

    <button onclick="guardarUsuario()">Guardar</button>
</div>

<hr>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios"></tbody>
</table>

<script src="../../../public/js/usuarios.js"></script>
