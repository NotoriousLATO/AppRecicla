<style>
body {
    background-color: #d4edda; /* Fondo verde claro */
    color: #333;
    font-family: 'Nunito', sans-serif;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    padding-top: 50px; /* Menos espacio arriba */
}



.form-container {
    background-color: white;
    padding: 30px; /* Menos padding para reducir la altura */
    border-radius: 10px;
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
    width: 600px; /* Aumentar el ancho del formulario */
    margin: 100px auto; /* Ajustar el margen superior para que esté más centrado */
}

.form-container h2 {
    text-align: center;
    margin-bottom: 20px; /* Ajustar margen inferior */
    font-size: 30px;
}

.form-container input,
.form-container select {
    width: 100%;
    padding: 15px; /* Ajustar padding para hacerlo más compacto */
    margin: 12px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 18px;
}

.form-container button {
    width: 100%;
    padding: 15px; /* Menos padding para el botón */
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 20px;
}

.form-container button:hover {
    background-color: #218838;
}

.form-container .error {
    color: red;
    font-size: 1.2rem;
}

.form-container p {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
}

.form-container a {
    color: #28a745;
    font-size: 18px;
}

@media (max-width: 768px) {
    .navbar {
        font-size: 22px; /* Ajustar tamaño de fuente en pantallas más pequeñas */
    }

    .form-container {
        width: 90%; /* Ajustar el ancho en pantallas pequeñas */
        margin: 80px auto; /* Reducir el margen superior */
    }

    .form-container input,
    .form-container select {
        font-size: 16px;
    }

    .form-container button {
        font-size: 18px;
    }
}
</style>
