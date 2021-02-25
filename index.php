<!doctype html>
<html lang="pt-br">

<head>
    <title>PHP DAO Generator</title>
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
                <h1 class="text-align-center">PHP DAO Generator</h1>
            </div>
        </div>
    </div>

    <hr>

    <!-- Dados de acesso -->
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>
                    <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Dados de acesso
                    </a>
                </h2>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <ul class="list-group list-group-flush">
                            <form action="">
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label for="banco" class="col-sm-2 col-form-label">Banco</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="banco" name="banco" placeholder="Informe o nome do banco">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Informe o nome do usuário de acesso (caso não informado, o padrão será 'root')">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label for="senha" class="col-sm-2 col-form-label">Senha <a href="#" class="badge badge-pill badge-secondary" id="passwordToggle" onclick="passwordHiddenAndShow('senha', 'passwordToggle')">O</a></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe o a senha de acesso (caso não informado o padrão será '')">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-primary">Aplicar alterações</button>
                                    </div>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fim Dados de acesso -->

    <div class="container my-5">
        <div class="row">
            <div class="col">
                <p class="text-align-center"><a href="gerar-dao.php" class="btn btn-success">Gerar novo DAO</a></p>
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