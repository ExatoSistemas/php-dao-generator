<?php
    if(!file_exists('informacoes-acesso.json')){
        header('Location: index.php');
    }

    require_once("classes/ConectaBd.php");
    include_once("classes/functions.php");

    $conectaBd = new ConectaBD(file_get_contents("informacoes-acesso.json"));
    $informacoesAcessoJson = json_decode(file_get_contents("informacoes-acesso.json"));

    $arquivosExistentes = []; // Guarda todos os arquivos existentes no diretório local para ver quais Daos já foram criados

    $path = $informacoesAcessoJson->path;
    $arquivos = glob($path."\*.php", GLOB_BRACE);
    for($a = 0; $a < count($arquivos); $a++){
        array_push($arquivosExistentes, explode("\\", $arquivos[$a])[count(explode("\\", $arquivos[$a]))-1]);
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
                    <?php
                        if(!in_array("Dao.php", $arquivosExistentes)){
                            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                            echo '    O checkbox abaixo foi automaticamente marcado porquê o DAO principal não foi encontrado no diretório atual';
                            echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            echo '        <span aria-hidden="true">&times;</span>';
                            echo '    </button>';
                            echo '</div>';
                        }
                    ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="gerarDaoPrincipal" id="gerarDaoPrincipal" value="gerarDaoPrincipal" <?php if(!in_array("Dao.php", $arquivosExistentes)) echo "checked"; ?>>
                            Gerar DAO principal
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <?php
                    $tablesBd = $conectaBd->getAllTables();
                    $tabelasSemDaoGeneric = [];
                    foreach($tablesBd as $tbl){
                        if(!in_array("Dao".underlineToCamelUp($tbl)."Generic.php", $arquivosExistentes)){
                            array_push($tabelasSemDaoGeneric, $tbl);
                        }
                    }

                    if(count($tabelasSemDaoGeneric) > 0){
                        echo '<div class="col-12">';
                        echo '    <div class="alert alert-info alert-dismissible fade show" role="alert">';
                        echo '        As tabelas que ainda não possuem DAO foram marcadas automaticamente';
                        echo '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '            <span aria-hidden="true">&times;</span>';
                        echo '        </button>';
                        echo '    </div>';
                        echo '    <p>Selecionar tabelas</p>';
                        echo '</div>';
                    }
                ?>

                <?php
                $tables = $conectaBd->getAllTables();
                $count = 1;
                foreach($tables as $tbl) {
                    if(in_array($tbl, $tabelasSemDaoGeneric)){
                        $checked = "checked";
                    } else {
                        $checked = "";
                    }

                    echo '<div class="col-3">';
                    echo '    <div class="form-check">';
                    echo '        <label class="form-check-label">';
                    echo '            <input type="checkbox" class="form-check-input" name="tbl'.$count.'" id="tbl'.$count.'" value="'.$tbl.'" '.$checked.' onclick="verificarSobreposicaoServices()">';
                    echo              $tbl;
                    echo '        </label>';
                    echo '    </div>';
                    echo '</div>';
                    $count++;
                }
                ?>
            </div>
            <hr>
            <div class="row">
                <?php
                    $tabelasSemDaoService = [];
                    foreach($tabelasSemDaoGeneric as $tblSemDaoGeneric){
                        $currentService = substr_replace("Generic", "Service", $tblSemDaoGeneric);
                        if(!in_array($currentService, $arquivosExistentes)){
                            array_push($tabelasSemDaoService, $tblSemDaoGeneric);
                        }
                    }
                ?>
                <div class="col">
                    <?php
                        if(count($tabelasSemDaoService) > 0){
                            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                            echo '    O checkbox abaixo foi automaticamente marcado porquê existem services que ainda não foram criados';
                            echo '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            echo '        <span aria-hidden="true">&times;</span>';
                            echo '    </button>';
                            echo '</div>';
                        }
                    ?>
                    <div id="alertDanger">
                        <!--
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Alguns services existentes serão sobrepostos, todas as edições feitas serão perdidas
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        -->
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="gerarService" id="gerarService" value="gerarService" <?php if(count($tabelasSemDaoService) > 0) echo "checked"; ?> onclick="verificarSobreposicaoServices()">
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
    <script>
        <?php
            echo "const arquivosExistentes = ["; foreach($arquivosExistentes as $arquivo){ echo "'".$arquivo."',"; } echo "];\n";

            echo "const tabelasSemDaoGeneric = ["; foreach($tabelasSemDaoGeneric as $tabela){ echo "'".$tabela."',"; } echo "];\n";

            echo "const tabelasSemDaoService = ["; foreach($tabelasSemDaoService as $tabela){ echo "'".$tabela."',"; } echo "];\n";

            $numTabelas = count($conectaBd->getAllTables());
            echo "const numTabelas = ".$numTabelas."\n";

            echo "const checkBoxTables = ["; for($tbl = 1; $tbl <= $numTabelas; $tbl++){ echo "{tabela: '".$tables[$tbl-1]."', input: document.querySelector('#tbl".$tbl."')},"; } echo "];";

        ?>

        const alertDanger = document.querySelector('#alertDanger');
        const gerarService = document.querySelector('#gerarService');

        function hiddenAlertDanger(){
            alertDanger.innerHTML = "";
        }

        function showAlertDanger(){
            alertDanger.innerHTML = '<div id="alertDanger"><div class="alert alert-danger alert-dismissible fade show" role="alert">Alguns services existentes serão sobrepostos, todas as edições feitas serão perdidas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
        }

        function verificarSobreposicaoServices(){
            if(gerarService.checked){
                let sobreposicao = false;
                for(let check = 0; check < checkBoxTables.length; check++){
                    const currentCheck = checkBoxTables[check]
                    if(currentCheck.input.checked){
                        if(arquivosExistentes.indexOf("Dao"+underlineToCamelUp(currentCheck.tabela)+"Service.php") != -1){
                            sobreposicao = true;
                        }
                    }
                }
                if(sobreposicao){
                    showAlertDanger();
                } else {
                    hiddenAlertDanger();
                }
            } else {
                hiddenAlertDanger()
            }
            console.log("verificado")
        }

        verificarSobreposicaoServices()

    </script>
    <script src="assets/js/fontawesome.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>