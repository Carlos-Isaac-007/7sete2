<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header com Barra de Pesquisa Estilizada</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* Header */
        .headernew {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #007bff;
            padding: 10px 20px;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Logotipo */
        .logo {
            flex: 0 0 20%;
            display: flex;
            align-items: center;
        }

        .logo img {
            max-width: 120%;
            height: 100px;
        }

        /* Barra de pesquisa */
        .search-box {
            flex: 0 0 80%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid transparent;
            border-radius: 25px;
            outline: none;
            background: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        /* Efeito ao clicar no input */
        .search-box input:focus {
            border: 2px solid #0056b3;
            box-shadow: 0 4px 12px rgba(0, 86, 179, 0.3);
        }

        /* Botão de pesquisa estilizado */
        .search-box button {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #007bff;
            transition: color 0.3s;
        }

        .search-box button:hover {
            color: #0056b3;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .headernew {
                flex-direction: column;
                height: auto;
                padding: 15px;
            }

            .logo {
                flex: 0 0 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .search-box {
                flex: 0 0 100%;
            }

            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Logotipo">
        </div>
        <div class="search-box">
            <input type="text" placeholder="Pesquisar...">
            <button type="submit">🔍</button>
        </div>
    </header>


    <div class="container">
<div class="d-flex justify-content-between align-items-center">

<div class="col-3 col-md-4 logo">
<a href="index.php"><img src="assets/uploads/<?php echo $logo; ?>" alt="logo image"></a>
</div>

<div class="col-md-3 col-xl-8  search-area">
<form class="navbar-form navbar-left" role="search" action="search-result.php" method="get">
<?php $csrf->echoInputField(); ?>
<div class="form-group">
<input type="text" class="form-control  search-top " placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text" id="IputPesquisar">
</div>
<button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
</form>
</div>


</div>
</div>

</body>
</html>
