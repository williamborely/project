<?php
define("HOSTNAME", "https://williamborely.github.io/project/");

/*   
  * Constantes de parâmetros para configuração da conexão   
  */
define('HOST', 'localhost');
define('DBNAME', 'economapas');
define('CHARSET', 'utf8');
define('USER', 'root');
define('PASSWORD', '');

try {
    $conn = new PDO('mysql:dbname=' . DBNAME . ';host=' . HOST, USER, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

session_start();

$geturl = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
array_shift($geturl);

/* FUNCTION LOGIN */

if (isset($_POST['entrar']) && $_POST['entrar'] == 'Entrar') {
    if ($_POST['login'] != '' && $_POST['password'] != '') {
        try {
            $sql = $conn->prepare("SELECT * FROM `users` WHERE `login`= :login");
            $sql->bindValue(":login", $_POST['login']);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);

            if ($result > 0) {
                if (password_verify($_POST['password'], $result['password'])) {
                    $_SESSION['login'] = $result['login'];
                    header("location: " . HOSTNAME . "home");
                } else {
                    echo 'Senha Inválida!';
                }
            } else {
                echo "Usuário não encontrado ou desativado!";
            }
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    } else {
        echo "Preenche E-mail e Senha!";
    }
}

/* FUNCTION LOGIN END */


/* FUNCTION GET STATES */

try {
    $sql = $conn->prepare("SELECT * FROM `states`");
    $sql->execute();
} catch (PDOException $e) {
    throw new PDOException($e);
}

/* FUNCTION GET STATES END */


/* FUNCTION GET GROUPS BY USER */
if(isset($_SESSION['login'])){


try {
    $sql2 = $conn->prepare("SELECT * FROM `groups` WHERE `user`='$_SESSION[login]'");
    $sql2->execute();
} catch (PDOException $e) {
    throw new PDOException($e);
}

}

/* FUNCTION GET GROUPS BY USER END */


/* FUNCTION INSERT GROUP BY USER END */

if (isset($_POST['action']) && $_POST['action'] == 'create_group') {
    try {
        $states = "";
        foreach ($_POST['states'] as $eachState) {
            $states .= $eachState . ",";
        }
        $sql = $conn->prepare("INSERT INTO `groups`(`id`, `group_name`, `state_id`, `user`) VALUES (NULL,'$_POST[group_name]','$states','$_SESSION[login]')");
        $sql->execute();
        header("location: " . HOSTNAME . "home");
    } catch (PDOException $e) {
        throw new PDOException($e);
    }
}

/* FUNCTION INSERT GROUP BY USER END */



/* FUNCTION GET GROUP BY ID FOR EDIT END */
if ($geturl[1] == 'home' && isset($geturl[3]) == 'edit') {
    try {
        $sql_get_groups_by_id = $conn->prepare("SELECT * FROM `groups` WHERE `id`='$geturl[2]'");
        $sql_get_groups_by_id->execute();
        $result_getGroupsById = $sql_get_groups_by_id->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new PDOException($e);
    }


    /* FUNCTION UPDATE/EDIT GROUP BY ID END */

    if (isset($_POST['action']) && $_POST['action'] == 'update_group') {
        try {
            $states = "";
            foreach ($_POST['states'] as $eachState) {
                $states .= $eachState . ",";
            }
            $sql = $conn->prepare("UPDATE `groups` SET `group_name`='$_POST[group_name]',`state_id`='$states',`user`='$_SESSION[login]' WHERE `id`='$geturl[2]'");
            $sql->execute();
            header("location: " . HOSTNAME . "home");
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    /* FUNCTION UPDATE/EDIT GROUP BY ID END */
}
/* FUNCTION GET GROUP BY ID FOR EDIT END */


/* FUNCTION GET GROUP BY ID FOR EDIT END */
if ($geturl[1] == 'home' && isset($geturl[3]) == 'delete') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete_group') {
        try {
            $sql_del_group = $conn->prepare("DELETE FROM `groups` WHERE `id`='$geturl[2]'");
            $sql_del_group->execute();
            header("location: " . HOSTNAME . "home");
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}
/* FUNCTION GET GROUP BY ID FOR EDIT END */


/* FUNCTION LOGOUT */
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    header("location: ".HOSTNAME);
}
/* FUNCTION LOGOUT END */
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="assets/images/acga.ico" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FeatherIcons-->
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Economapas - TESTE</title>
</head>

<body style="text-align: center; width: 50%;">

    <?php if ($geturl[1] != '') { ?>
        <form action="" method="post">
            <button class="btn btn-primary" type="submit" name="action" value="logout">Sair</button>
        </form>
    <?php } ?>
    <?php if($geturl[1] == 'home'){ echo '<div class="container-fluid"><div class="row"><h1>Dashboard</h1></div></div>'; } ?>

    <?php if ($geturl[1] == '' && isset($geturl[3]) == '') { ?>

        <div class="container login">
            <div class="loginBox">
                <img class="user" src="" alt="LOGOTIPO" height="100px" width="120px">
                <br>
                <br>
                <form $geturl[3]="" method="POST">
                    <div class="inputBox">
                        <input class="form-control" id="uname" type="text" id="login" name="login" placeholder="Usuário">
                        <br>
                        <input class="form-control" id="pass" type="password" id="password" name="password" placeholder="Senha">
                    </div>
                    <br>
                    <input class="btn btn-primary" type="submit" id="entrar" name="entrar" value="Entrar">
                </form>
            </div>
        </div>

    <?php } else if ($geturl[1] == 'home' && isset($geturl[3]) == '') { ?>
        
            <div class="row" style="margin-top:60px;">
                <h3>Criar Novo Grupo</h3>
                <form action="" method="POST">
                    <label for="group_name">Nome do Grupo</label>
                    <br>
                    <input class="form-control" type="text" name="group_name" id="group_name" placeholder="Nome do Grupo">
                    <br>
                    <br>
                    <label for="states">Selecione até 5 Municípios</label>
                    <br>
                    <select name="states[]" id="states" multiple style="width: 50%;height: 300px;">
                        <option value=""> - </option>
                        <?php while ($resultStates = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $resultStates['id'] ?>"><?= $resultStates['city'] ?> - <?= $resultStates['uf'] ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <br>
                    <button class="btn btn-primary" type="submit" name="action" value="create_group">Criar Grupo</button>
                </form>
            </div>
            <div class="row" style="margin-top:60px;">
                <h3>Lista de Grupos (Grupos do Usuário) </h3>

                <table>
                    <tr>
                        <th>Nome do Grupo</th>
                        <th>Municípios - UF</th>
                        <th>Ações</th>
                    </tr>
                    <tr>
                        <?php while ($resultUserGroups = $sql2->fetch(PDO::FETCH_ASSOC)) { ?>

                            <td><?= $resultUserGroups['group_name'] ?></td>

                            <td>
                                <?php
                                $statesId = explode(',', $resultUserGroups['state_id']);
                                for ($i = 0; $i < sizeof($statesId); $i++) {

                                    try {
                                        $sql_get = $conn->prepare("SELECT * FROM `states` WHERE `id`='$statesId[$i]'");
                                        $sql_get->execute();
                                        $result_get = $sql_get->fetch(PDO::FETCH_ASSOC);
                                        if ($result_get != null) {
                                            echo $result_get['city'] . ', ';
                                        }
                                    } catch (PDOException $e) {
                                        throw new PDOException($e);
                                    }
                                }
                                ?>
                            </td>

                            <td>
                                <a class="btn btn-primary" href="<?= HOSTNAME . "home" . "/" . $resultUserGroups['id'] . "/edit" ?>">Editar</a>
                                <a class="btn btn-danger" href="<?= HOSTNAME . "home" . "/" . $resultUserGroups['id'] . "/delete" ?>">Excluir</a>
                            </td>

                        <?php } ?>
                    </tr>
                </table>

            </div>
    <?php } else if ($geturl[1] == 'home' && $geturl[3] == 'edit') { ?>
        
            <div class="row" style="margin-top:60px;">
                <h3>Editar Grupo</h3>
                <form $geturl[3]="" method="POST">
                    <label for="group_name">Nome do Grupo</label>
                    <br>
                    <input class="form-control" type="text" name="group_name" id="group_name" placeholder="Nome do Grupo" value="<?= $result_getGroupsById['group_name'] ?>">
                    <br>
                    <br>
                    <label for="states">Selecione até 5 Municípios</label>
                    <br>
                    <select name="states[]" id="states" multiple style="width: 20%;height: 300px;">
                        <option value=""> - </option>
                        <?php while ($resultStates = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $resultStates['id'] ?>" <?php
                                                                        $statesId = explode(',', $result_getGroupsById['state_id']);
                                                                        for ($i = 0; $i < sizeof($statesId); $i++) {
                                                                            if ($resultStates['id'] == $statesId[$i]) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>>
                                <?= $resultStates['city'] ?> - <?= $resultStates['uf'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br>
                    <br>
                    <button class="btn btn-primary" type="submit" name="action" value="update_group">Editar Grupo</button>
                </form>
                <br>
                <a href="<?= HOSTNAME . "home" ?>">Cancelar</a>
            </div>
    <?php } else if ($geturl[1] == 'home' && $geturl[3] == 'delete') { ?>
        
            <div class="row" style="margin-top:60px;">
                <h3>Excluir Grupo</h3>
                <br>
                <p>Você realmente deseja excluir este grupo?</p>
                <br>
                <form action="" method="POST">
                    <button class="btn btn-success" type="submit" name="action" value="delete_group">Excluir</button>
                </form>
                <br>
                <a class="btn btn-secondary" href="<?= HOSTNAME . "home" ?>">Cancelar</a>
            </div>
    <?php } ?>

    <?php echo '</div>';?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        feather.replace()
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var last_valid_selection = null;

            $('#states').change(function(event) {

                if ($(this).val().length > 5) {

                    $(this).val(last_valid_selection);
                } else {
                    last_valid_selection = $(this).val();
                }
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>