<!-- header.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .navbar {
            background-color: #007bff; 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); 
        }
        .nav-link {
            font-size: 18px;
            color: #fff; 
            transition: color 0.3s ease-in-out;
            margin-right: 10px; 
        }
        .nav-link:hover {
            color: #cce5ff; 
        }
        .nav-item:last-child .nav-link {
            margin-right: 0;
        }
        .navbar-nav .nav-link {
            color: #fff; 
            background-color: #707070; 
            border-radius: 5px; 
            padding: 8px 16px; 
            transition: background-color 0.3s ease-in-out; 
        }
        .navbar-nav .nav-link:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="../../index.php">Prova PHP SQL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/system/colors/list.php">Gerenciar Cores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/system/users/list.php">Usuários</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
