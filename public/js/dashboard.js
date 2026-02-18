function cargarSeccion(seccion) {
    let url;
    
    if (seccion === 'clientes') {
        // Apuntamos al controlador a través de routes.php
        url = "/EquilibriumWellnessClub/routes.php?action=listarClientes";
    } else {
        url = "/EquilibriumWellnessClub/app/views/admin/secciones/" + seccion + ".php";
    }

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error("Error en la red");
            return response.text();
        })
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

// public/js/dashboard.js

// Escuchar todos los submits del documento
document.addEventListener('submit', function (e) {
    // Si el formulario que se envía es el de insertar cliente
    if (e.target && e.target.id === 'formInsertarCliente') {
        e.preventDefault();
        console.log("Iniciando envío de cliente...");

        const formData = new FormData(e.target);

        fetch('/EquilibriumWellnessClub/routes.php?action=guardarCliente', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Éxito")) {
                cargarSeccion('clientes'); // Recargar la tabla
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error al conectar con el servidor");
        });
    }
});

// Función para cargar el formulario de edición
function editarCliente(id) {
    fetch(`/EquilibriumWellnessClub/routes.php?action=editarCliente&id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        });
}

// Función para eliminar cliente
function eliminarCliente(id) {
    if (confirm("¿Estás seguro de eliminar este cliente?")) {
        fetch(`/EquilibriumWellnessClub/routes.php?action=eliminarCliente&id=${id}`)
            .then(response => response.text())
            .then(data => {
                alert(data);
                cargarSeccion('clientes');
            });
    }
}

// Escuchar el submit del formulario de edición
document.addEventListener('submit', function (e) {
    if (e.target && e.target.id === 'formEditarCliente') {
        e.preventDefault();
        const formData = new FormData(e.target);

        fetch('/EquilibriumWellnessClub/routes.php?action=actualizarCliente', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Éxito")) cargarSeccion('clientes');
        });
    }
});



