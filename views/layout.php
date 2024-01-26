<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? null;

if (!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienes Raices</title>
        <link rel="stylesheet" href="/public/build/css/app.css">
    </head>

    <body>

        <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img src="/public/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                    </a>

                    <div class="mobile-menu">
                        <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                    </div>

                    <div class="derecha">
                        <img class="dark-mode-boton" src="/public/build/img/dark-mode.svg">
                        <nav class="navegacion">
                            <a href="/nosotros">Nosotros</a>
                            <a href="/propiedades">Anuncios</a>
                            <a href="/blog">Blog</a>
                            <a href="/contacto">Contacto</a>
                            <?php if ($auth) : ?>
                                <a href="/logout">Cerrar Sesion</a>
                            <?php else : ?>
                                <a href="/login">Iniciar Sesion</a>
                            <?php endif; ?>
                        </nav>
                    </div>

                </div> <!--.barra-->

                <?php if ($inicio) : ?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                <?php endif; ?>
            </div>
        </header>

        <?php echo $contenido; ?>

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>

            <p class="copyright">Todos los derechos Reservados 2023 &copy;</p>
        </footer>

        <script src="/public/build/js/bundle.min.js"></script>
    </body>

    </html>