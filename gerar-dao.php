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
        <div class="container">
            <div class="row">
                <div class="col">
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
                    <p>Selecionar tabelas</p>
                </div>
                <?php
                for ($i = 1; $i < 12; $i++) {
                ?>
                    <div class="col-3">
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
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="" value="">
                            Além do DAO genérico gerar um DAO para edições
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <p>Caminho para o dao <a href="#" class="badge badge-secondary" data-toggle="modal" data-target="#infoPath">?</a></p>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" id="path" name="path" placeholder="Cole aqui o caminho para onde vai ficar o DAO">
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

    <!-- Modal infoPath -->
    <div class="modal fade" id="infoPath" tabindex="-1" role="dialog" aria-labelledby="infoPath" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Esse é o caminho absoluto para o diretório onde vai ficar o DAO</p>
                    <img src="assets/images/caminho-exemplo.png" alt="" class="img-fluid">
                    <p>Clique no caminho para selecionar, copie e cole no input abaixo</p>
                    <img src="assets/images/caminho-exemplo-selecionado.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="assets/js/functions.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>