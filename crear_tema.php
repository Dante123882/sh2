<?php
session_start(); // Inicia la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nuevo_tema'])) {
    $nuevo_tema = trim($_POST['nuevo_tema']);
    $nombre_archivo_html = strtolower(str_replace(' ', '-', $nuevo_tema)) . '.html';

    // Guarda el nombre del tema en un archivo de texto
    file_put_contents('temas.txt', $nuevo_tema . PHP_EOL, FILE_APPEND);

    // Crea el archivo HTML para el nuevo tema
    $contenido_html = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . htmlspecialchars($nuevo_tema) . '</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>' . htmlspecialchars($nuevo_tema) . '</h1>
        <p>¡Este es un tema generado automáticamente!</p>
        <a href="index.php">Volver al Menú Principal</a>
    </body>
    </html>
    ';
    file_put_contents($nombre_archivo_html, $contenido_html);

    // Almacena un mensaje de éxito en una variable de sesión
    $_SESSION['mensaje'] = "Envío correcto, lo verificaremos. Gracias por tu sugerencia.";
    
    // Redirige al usuario de vuelta a la página principal
    header('Location: index.php');
    exit;
}
?>