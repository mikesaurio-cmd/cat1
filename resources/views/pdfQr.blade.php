<!DOCTYPE html>
<html>
<head>
<style>
    body {
        background-color: #d3d3d3; /* Color de fondo gris */
        margin: 0; /* Elimina el margen predeterminado del cuerpo */
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 0; /* Elimina el borde del contenedor */
        padding: 20px;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: auto;
        margin-bottom: 20px; /* Espacio entre la imagen y el código QR */
    }

    .qr-code {
        width: 300px;
        height: 300px;
    }
</style>
</head>
<body>
    <div class="container">
        <img class="logo" src="https://informatica.simasatechnologies.com/cat/public/imagenes/simasa.png" alt="Simasa Logo">
        <br>
        <img class="qr-code" src="{{ url('https://informatica.simasatechnologies.com/cat/public/' . $info->qrPieza) }}" alt="Código QR">
    </div>
</body>
</html>
