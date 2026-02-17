function cargarContenido(abrir) {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch(abrir)
    .then((response) => response.text())
    .then((data) => (contenedor.innerHTML = data));
}
function confirmarInsertarCliente(url) {
    mostrarModal("¿Está seguro de insertar este cliente?");
    document.getElementById("confirmarBtn").onclick = function() {
        insertar_c(url);
        cerrarModal();
    }
}
function insertar_c(url) {
  const datos = new FormData(document.querySelector("form"));
  fetch(url, { method: "POST", body: datos })
    .then(response => response.text())
    .then(data => {
      mostrarModalConfirmacion(data);
    });
}

function confirmarInsertarPago(url) {
    mostrarModal("¿Está seguro de insertar este pago?");
    document.getElementById("confirmarBtn").onclick = function() {
        insertar_pago(url);
        cerrarModal();
    }   
}

function insertar_pago(url) {
  const datos = new FormData(document.querySelector("form"));
  fetch(url, { method: "POST", body: datos })
    .then(response => response.text())
    .then(data => {
      mostrarModalConfirmacion(data);
    });
}

function mostrarModal(mensaje) {
  document.getElementById("modalTexto").innerText = mensaje;
  document.getElementById("modalMensaje").style.display = "block";
}
function mostrarModalConfirmacion(mensaje) {
  document.getElementById("modalConfirmacion").innerText = mensaje;
  document.getElementById("modalMensajeConfirmacion").style.display = "block";
          setTimeout(()=>{
            cerrarModalConfirmacion();
        },1000)

}

function cerrarModal() {
    document.getElementById("modalMensaje").style.display = "none";
}

function cerrarModalConfirmacion() {
    document.getElementById("modalMensajeConfirmacion").style.display = "none";
}




