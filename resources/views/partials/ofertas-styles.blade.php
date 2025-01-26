<style>


.container {
    margin-top: 20px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 100%; /* Ancho máximo del container al 100% */
    margin-left: 0; /* Elimina los márgenes laterales */
    margin-right: 0;
}

.table {
    width: 95%; /* La tabla ocupa todo el ancho del container */
    margin: 0; /* Elimina los márgenes de la tabla */
    border-collapse: collapse;
    background-color: #fff;
    font-size: 14px;
}


h1 {
    text-align: left;
    color: #333;
    margin-bottom: 15px;
    font-size: 24px;
    display: inline-block; /* Mantiene el título en la misma línea */
}
.table-responsive {
    margin-top: 10px;
    overflow-x: auto;
}

.table {
    width: 90%; /* La tabla ocupa casi todo el ancho del container */
    margin: auto;
    border-collapse: collapse;
    background-color: #fff;
    font-size: 14px;
}

.table th,
.table td {
    padding: 12px; /* Mayor espaciado para mejor legibilidad */
    text-align: center;
    vertical-align: middle;
    border: 1px solid #ddd;
}

.table th {
    background-color:rgb(49, 159, 124);
    color: #fff;
    font-weight: bold;
}

.table td {
    color: #555;
}

.table img {
    border-radius: 5px;
    max-width: 100px; /* Ajusta el tamaño máximo de las imágenes */
    height: auto;
    transition: transform 0.2s ease-in-out;
}

.table img:hover {
    transform: scale(1.2);
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 15px;
}

.pagination .page-item .page-link {
    padding: 8px 12px;
    margin: 0 5px;
    border-radius: 5px;
    color: #007bff;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    transition: background-color 0.2s ease-in-out;
}

.pagination .page-item .page-link:hover {
    background-color: #007bff;
    color: #fff;
}

/* Estilo general de la vista create  */

   /* Contenedor principal de la vista create */
.form-container {
    width: 60%; /* Ajusta el ancho a un 60% del contenedor */
    margin: 0 auto; /* Centra el contenedor horizontalmente */
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Ajuste de márgenes para los campos de formulario */
label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    color: #555;
}

/* Estilo de los campos de entrada */
input[type="text"],
input[type="number"],
select,
input[type="file"] {
    width: 100%; /* Asegura que los campos se ajusten al ancho del contenedor */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}

/* Botones en la vista create */
button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Map container y mapa ajustado */
.map-container {
    margin-top: 20px;
    width: 100%;
}

/* Para que el mapa ocupe un 100% del ancho disponible */
#map {
    width: 100%;
    height: 300px;
    border-radius: 10px;
    border: 1px solid #ccc;
}

/* Ajustar el ancho de la lista de direcciones */
.address-dropdown {
    background-color: #fff;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #333;
    width: 100%;
}

/* forrmulario vista show */



</style>
