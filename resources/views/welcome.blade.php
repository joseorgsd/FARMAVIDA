<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FARMAVIDA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero{
            background:#198754;
            color:white;
            padding:100px 20px;
            text-align:center;
        }

        .section{
            padding:60px 20px;
        }

        .card{
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }
    </style>
</head>
<body>

<section class="hero">
    <h1 class="display-4">FARMAVIDA</h1>

    <p class="lead">
        Sistema Integral de Gestión Farmacéutica
    </p>

    <p>
        Plataforma web que permite administrar medicamentos,
        clientes, médicos y ventas de manera eficiente.
    </p>

    <a href="{{ route('login') }}"
       class="btn btn-light btn-lg">
        Iniciar Sesión
    </a>
</section>

<section class="section container">
    <h2 class="text-center mb-5">
        ¿Qué ofrece FARMAVIDA?
    </h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h4>Medicamentos</h4>
                <p>
                    Registro y control de inventario.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h4>Clientes</h4>
                <p>
                    Gestión completa de clientes.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h4>Médicos</h4>
                <p>
                    Registro de médicos autorizados.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center">
                <h4>Ventas</h4>
                <p>
                    Registro seguro y controlado.
                </p>
            </div>
        </div>

    </div>
</section>

<section class="section bg-light">
    <div class="container">

        <h2 class="text-center mb-4">
            Beneficios del Sistema
        </h2>

        <ul class="list-group">
            <li class="list-group-item">
                Control eficiente del stock.
            </li>
            <li class="list-group-item">
                Reducción de errores operativos.
            </li>
            <li class="list-group-item">
                Mayor rapidez en las ventas.
            </li>
            <li class="list-group-item">
                Información centralizada.
            </li>
            <li class="list-group-item">
                Mejor atención al cliente.
            </li>
        </ul>

    </div>
</section>

<section class="section text-center">
    <h2>
        Comience a gestionar su farmacia hoy
    </h2>

    <p>
        Acceda al sistema y optimice todos sus procesos.
    </p>

    <a href="{{ route('login') }}"
       class="btn btn-success btn-lg">
        Acceder al Sistema
    </a>
</section>

<footer class="bg-dark text-white text-center p-3">
    © 2026 FARMAVIDA - Sistema de Gestión Farmacéutica
</footer>

</body>
</html>