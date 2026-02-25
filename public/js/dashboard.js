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

function cargarSeccion(seccion) {
    let url;
    
    if (seccion === 'pagos') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPagos";
    } else if (seccion === 'form_registrar_pago') {
        // Importante: El formulario de pago también debe pasar por el controlador
        url = "/EquilibriumWellnessClub/routes.php?action=nuevoPago";
    } else if (seccion === 'clientes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarClientes";
    } else if (seccion === 'planes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPlanes";
    } else {
        url = "/EquilibriumWellnessClub/app/views/admin/secciones/" + seccion + ".php";
    }

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => console.error("Error:", error));
}



// public/js/dashboard.js

function cargarSeccion(seccion) {
    let url;
    
    if (seccion === 'avisos') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarAvisos";
    } else if (seccion === 'form_registrar_aviso') {
        // Necesario para que el controlador cargue los <select> de clientes y planes
        url = "/EquilibriumWellnessClub/routes.php?action=nuevoAviso";
    } else if (seccion === 'clientes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarClientes";
    } else if (seccion === 'planes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPlanes";
    } else if (seccion === 'pagos') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPagos";
    } else {
        url = "/EquilibriumWellnessClub/app/views/admin/secciones/" + seccion + ".php";
    }

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => console.error("Error en cargarSeccion:", error));
}

// public/js/dashboard.js

function eliminarAviso(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este aviso?")) {
        // Llamamos a la acción eliminarAviso en routes.php
        fetch(`/EquilibriumWellnessClub/routes.php?action=eliminarAviso&id=${id}`)
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrará "Éxito: Aviso eliminado"
                if (data.includes("Éxito")) {
                    cargarSeccion('avisos'); // Refresca la tabla automáticamente
                }
            })
            .catch(error => console.error('Error:', error));
    }
}
// ÚNICO ESCUCHADOR DE SUBMITS
document.addEventListener('submit', function (e) {
    const form = e.target;
    const formsAJAX = ['formInsertarCliente', 'formEditarCliente', 'formInsertarPlan', 'formEditarPlan', 'formInsertarPago', 'formInsertarAviso'];

    if (form && formsAJAX.includes(form.id)) {
        e.preventDefault();

        // --- BLOQUEO PARA EVITAR DOBLE INSERCIÓN ---
        const btn = form.querySelector('button[type="submit"]');
        if (btn.disabled) return; // Si ya se está enviando, ignoramos el segundo clic
        btn.disabled = true;
        btn.innerText = "Guardando...";
        // -------------------------------------------

        const acciones = {
            'formInsertarCliente': 'guardarCliente',
            'formEditarCliente': 'actualizarCliente',
            'formInsertarPlan': 'guardarPlan',
            'formEditarPlan': 'actualizarPlan',
            'formInsertarPago': 'guardarPago',
            'formInsertarAviso': 'guardarAviso'
        };

        const formData = new FormData(form);
        fetch(`/EquilibriumWellnessClub/routes.php?action=${acciones[form.id]}`, {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            alert(data);
            if (data.includes("Éxito")) {
                // Recargar tabla correspondiente
                let recarga = 'clientes';
                if (form.id.includes('Plan')) recarga = 'planes';
                else if (form.id.includes('Pago')) recarga = 'pagos';
                else if (form.id.includes('Aviso')) recarga = 'avisos';
                cargarSeccion(recarga);
            } else {
                btn.disabled = false; // Si falló, dejamos intentar de nuevo
                btn.innerText = "Guardar";
            }
        })
        .catch(err => {
            btn.disabled = false;
            console.error(err);
        });
    }
});

// public/js/dashboard.js

function cargarSeccion(seccion) {
    let url;
    
    if (seccion === 'form_registrar_pago') {
        // FORZAMOS que pase por el controlador para llenar los <select>
        url = "/EquilibriumWellnessClub/routes.php?action=nuevoPago";
    } else if (seccion === 'pagos') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPagos";
    } else if (seccion === 'clientes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarClientes";
    } else if (seccion === 'planes') {
        url = "/EquilibriumWellnessClub/routes.php?action=listarPlanes";
    } else {
        url = "/EquilibriumWellnessClub/app/views/admin/secciones/" + seccion + ".php";
    }

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => console.error("Error:", error));
}