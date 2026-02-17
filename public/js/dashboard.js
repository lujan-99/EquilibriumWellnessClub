function cargarSeccion(seccion) {

    fetch("views/admin/secciones/" + seccion + ".php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("contenido-dinamico").innerHTML = data;
        })
        .catch(error => {
            console.error("Error:", error);
        });

}
