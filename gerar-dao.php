<?php
    if(!file_exists('informacoes-acesso.json')){
        header('Location: index.php');
    }
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Gerar novo Dao</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container my-4">
        <div class="row">
            <div class="col">
                <h1 class="text-align-center">Gerar novo DAO</h1>
            </div>
        </div>
    </div>

    <hr>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Início</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerar novo DAO</li>
        </ol>
    </nav>

    <form action="">
        <div class="container mb-5">
            <div class="row">
                <div class="col">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        O checkbox abaixo foi automaticamente marcado porquê o DAO principal não foi encontrado no diretório atual
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="" value="">
                            Gerar DAO principal
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        As tabelas que ainda não possuem DAO foram marcadas automaticamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p>Selecionar tabelas</p>
                </div>
                <?php
                for ($i = 1; $i < 12; $i++) {
                ?>
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id="" value="">
                                Tabela numero <?php echo $i; ?>
                            </label>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        O checkbox abaixo foi automaticamente marcado porquê existem servers que ainda não foram criados
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Alguns servers existentes serão sobrepostos, todas as edições feitas serão perdidas
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="" value="">
                            Além do DAO genérico gerar o server para edições personalizadas no DAO
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Gerar DAO</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Optional JavaScript -->
    <script src="assets/js/functions.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>