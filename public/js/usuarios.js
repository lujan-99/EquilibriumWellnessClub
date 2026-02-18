document.addEventListener("DOMContentLoaded", listarUsuarios);

function listarUsuarios() {
    fetch("../../../routes.php?action=listarUsuarios")
        .then(res => res.json())
        .then(data => {

            let html = "";

            data.forEach(u => {
                html += `
                <tr>
                    <td>${u.idCliente}</td>
                    <td>${u.nombre}</td>
                    <td>${u.gmail}</td>
                    <td>${u.rol}</td>
                    <td>
                        <button onclick="eliminar(${u.idCliente})">Eliminar</button>
                    </td>
                </tr>`;
            });

            document.getElementById("tablaUsuarios").innerHTML = html;
        });
}

function guardarUsuario() {

    let formData = new FormData();
    formData.append("nombre", document.getElementById("nombre").value);
    formData.append("gmail", document.getElementById("gmail").value);
    formData.append("password", document.getElementById("password").value);
    formData.append("rol", document.getElementById("rol").value);
    formData.append("action", "crearUsuario");

    fetch("../../../routes.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(() => {
        listarUsuarios();
        alert("Usuario creado");
    });
}

function eliminar(id) {

    let formData = new FormData();
    formData.append("id", id);
    formData.append("action", "eliminarUsuario");

    fetch("../../../routes.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(() => {
        listarUsuarios();
    });
}
