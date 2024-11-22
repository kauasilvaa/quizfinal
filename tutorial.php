<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h1 {
            color: #3b5998;
            text-align: center;
            margin-bottom: 20px;
        }

        .video-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .download-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .download-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Tutorial de Como Usar o Quiz</h1>

        <!-- Vídeo do tutorial -->
        <div class="video-container">
            <video width="100%" controls>
                <source src="videos/tutorial.mp4" type="video/mp4">
                <source src="videos/tutorial.webm" type="video/webm">
                <source src="videos/tutorial.ogv" type="video/ogg">
                Seu navegador não suporta a tag de vídeo.
            </video>
        </div>

        <!-- Link para download do vídeo -->
        <a href="videos/tutorial.mp4" download class="download-link">Baixar vídeo para assistir offline</a>
    </div>

</body>
</html>
