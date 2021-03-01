<?php
    if(!file_exists('informacoes-acesso.json')){
        header('Location: index.php');
    }

    require_once("classes/ConectaBd.php");

    $conectaBd = new ConectaBD(file_get_contents("informacoes-acesso.json"));

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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Início</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerar novo DAO</li>
        </ol>
    </nav>

    <form action="processos/process-gerar-dao.php" method="post">
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
                            <input type="checkbox" class="form-check-input" name="gerarDaoPrincipal" id="gerarDaoPrincipal" value="gerarDaoPrincipal">
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
                $tables = $conectaBd->getAllTables();
                $count = 1;
                foreach($tables as $tbl) {
                    echo '<div class="col-3">';
                    echo '    <div class="form-check">';
                    echo '        <label class="form-check-label">';
                    echo '            <input type="checkbox" class="form-check-input" name="tbl'.$count.'" id="tbl'.$count.'" value="'.$tbl.'">';
                    echo $tbl;
                    echo '        </label>';
                    echo '    </div>';
                    echo '</div>';
                    $count++;
                }
                ?>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        O checkbox abaixo foi automaticamente marcado porquê existem services que ainda não foram criados
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Alguns services existentes serão sobrepostos, todas as edições feitas serão perdidas
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="gerarService" id="gerarService" value="gerarService">
                            Além do DAO genérico gerar o service para edições personalizadas no DAO
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <input type="hidden" name="numTables" value="<?php echo count($conectaBd->getAllTables()); ?>">
                    <button type="submit" class="btn btn-primary">Gerar DAO</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Optional JavaScript -->
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/fontawesome.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>