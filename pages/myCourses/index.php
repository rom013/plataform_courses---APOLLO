<!DOCTYPE html>
<html lang="pt-BR">
<?php 
    include "../../database/database.php";
    session_start();

    if(!isset($_SESSION["user"])){
        header("Location: ../../");
    }
    $codeUser = $_SESSION["cd_user"];
    $sql = "SELECT TC.cd_curso, TC.nm_curso, TC.duracao, TC.valor, TC.dt_publicacao, TP.nm_prof, TD.nm_diciplina, TD.bg_diciplina FROM tb_curso TC INNER JOIN tb_professor TP ON (TC.cd_prof = TP.cd_prof) INNER JOIN tb_diciplina TD ON (TC.diciplina = TD.cd_diciplina) WHERE TC.cd_prof = '$codeUser'";

    try {
        $query = mysqli_query($conexao, $sql);
    } catch (Exception $th) {
        echo $th->getMessage();
    }


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/myCourses.css">
    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>APOLLO - Meus cursos</title>
</head>

<body>
    <header class="page-header">
        <div class="container-header">
            <a href="http://localhost/atv_banco_cursos" class="logo">
                APOLLO
            </a>
            <div class="profile-container">
                <span>Olá! 
                    <?php 
                        echo $_SESSION["user"];
                    ?>
                </span>
                <div class="profile-info">
                    <a href="./">Meus cursos</a>
                    <a href="../../logout.php">Sair</a>
                </div>
            </div>
        </div>
    </header>

    <?php 

        if(!empty($_SESSION["message"])){
            echo "
                <div class='{$_SESSION["message"]["type"]}'>
                    {$_SESSION["message"]["message"]}
                </div>
            ";
            unset($_SESSION["message"]);
        }
    ?>

    <main class="container-courses">
        <section>
            <div class="subtitle">
                <h2>Meus cursos</h2>
                <div class="flex">
                    <a href="http://localhost/atv_banco_cursos/pages/addCourse/">
                        <span class="material-symbols-outlined">
                            edit_square
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-courses">
                <?php 
                    if($query->num_rows > 0){
                        while($curso = $query->fetch_assoc()){
                            $dateFormat = date("d/m/Y", strtotime($curso["dt_publicacao"]));
                            $valor = $curso["valor"];
                            if($valor == 0){
                                $valor = "grátis";
                            }
                            else{
                                $valor = "R$ {$curso["valor"]}";
                            }

                            echo
                            '
                                <div class="card-course">
                                    <div class="btn-edits">
                                        <div class="edit" id="'.$curso["cd_curso"].'">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </div>
                                        <div class="delete" id="'.$curso["cd_curso"].'">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </div>
                                    </div>
                                    <div class="header-card">
                                        <div class="img-course">
                                            <div style="background:'.$curso["bg_diciplina"].'; width: 100%; height: 100%;"></div>
                                        </div>
                                        <span class="date">'.$dateFormat.'</span>
                                    </div>
                                    <div class="main-card">
                                        <span class="discipline">'.$curso["nm_diciplina"].'</span>
                                        <h4 class="title-course">'.$curso["nm_curso"].'</h4>
                                        <div class="flex">
                                            <strong class="course-cost">'.$valor.'</strong>
                                            <span class="time">'.$curso["duracao"].' horas</span>
                                        </div>
                                        <span class="createdBy">Criado por: '.$curso["nm_prof"].'</span>
                                    </div>
                                </div>

                            ';
                        }
                    }
                    else{
                        echo "<span class='text-new-course'>Explore novos horizontes! Comece criando seu primeiro curso <a href='http://localhost/atv_banco_cursos/pages/addCourse/'>agora mesmo.</a></span>";
                    }
                ?>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
    <script>
        setTimeout(()=>{
            document.querySelector(".sucess").remove()
        }, 10000)   
    </script>
</body>

</html>