// public/js/dashboard.js

function cargarSeccion(seccion) {
    let url;
    
    // Casos que requieren lógica de controlador (Base de Datos)
    if (seccion === 'planes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPlanes";
    } else if (seccion === 'clientes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarClientes";
    } 
    // Casos de formularios estáticos
    else {
        // Asegúrate de que la ruta coincida con tu carpeta física
        url = "/EquilibriumWellnessClub/app/views/admin/secciones/" + seccion + ".php";
    }

    console.log("Cargando desde: " + url); // Esto te dirá el error exacto en la consola

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error("No se encontró el archivo en: " + url);
            return response.text();
        })
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => {
            console.error("Error en cargarSeccion:", error);
        });
}

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



// public/js/dashboard.js

document.addEventListener('submit', function (e) {
    const form = e.target;
    
    // Lista de formularios que manejaremos por AJAX
    const formsPermitidos = ['formInsertarCliente', 'formEditarCliente', 'formInsertarPlan', 'formEditarPlan'];

    if (form && formsPermitidos.includes(form.id)) {
        e.preventDefault();
        
        // Determinamos la acción de routes.php basándonos en el ID del formulario
        let accion;
        if (form.id === 'formInsertarPlan') accion = 'guardarPlan';
        else if (form.id === 'formEditarPlan') accion = 'actualizarPlan';
        else if (form.id === 'formInsertarCliente') accion = 'guardarCliente';
        else if (form.id === 'formEditarCliente') accion = 'actualizarCliente';

        const formData = new FormData(form);

        fetch(`/EquilibriumWellnessClub/routes.php?action=${accion}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Éxito")) {
                // Si es un plan, recargamos la sección de planes
                const seccion = form.id.toLowerCase().includes('plan') ? 'planes' : 'clientes';
                cargarSeccion(seccion);
            }
        })
        .catch(error => console.error('Error:', error));
    }
});


// public/js/dashboard.js

// Función global para eliminar planes
function eliminarPlan(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este plan?")) {
        console.log("Eliminando plan ID: " + id);
        
        fetch(`/EquilibriumWellnessClub/routes.php?action=eliminarPlan&id=${id}`)
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrará "Éxito: Plan eliminado"
                if (data.includes("Éxito")) {
                    cargarSeccion('planes'); // Refresca la tabla automáticamente
                }
            })
            .catch(error => console.error('Error:', error));
    }
}



// public/js/dashboard.js

// Función para cargar el formulario de edición del plan
function editarPlan(id) {
    console.log("Cargando edición para Plan ID: " + id);
    
    // Llamamos a la acción editarPlan en routes.php
    fetch(`/EquilibriumWellnessClub/routes.php?action=editarPlan&id=${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Error al obtener el formulario");
            return response.text();
        })
        .then(html => {
            // Insertamos el formulario en el área dinámica
            document.getElementById("contenido-dinamico").innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}

// public/js/dashboard.js

document.addEventListener('submit', function (e) {
    const form = e.target;
    
    // Lista de formularios que procesaremos por AJAX
    const formulariosCRUD = ['formInsertarCliente', 'formEditarCliente', 'formInsertarPlan', 'formEditarPlan'];

    if (form && formulariosCRUD.includes(form.id)) {
        e.preventDefault();
        
        // Mapeo automático de IDs a acciones del routes.php
        let accion;
        if (form.id === 'formEditarPlan') accion = 'actualizarPlan';
        else if (form.id === 'formInsertarPlan') accion = 'guardarPlan';
        // ... (otros formularios)

        const formData = new FormData(form);

        fetch(`/EquilibriumWellnessClub/routes.php?action=${accion}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Éxito")) {
                cargarSeccion('planes'); // Refresca la tabla automáticamente
            }
        })
        .catch(error => console.error('Error:', error));
    }
});