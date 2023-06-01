<?php 
    include "database/database.php";
    session_start();

    $selectCoursesSQL = "SELECT TC.nm_curso, TC.duracao, TD.nm_diciplina, TC.valor, TP.nm_prof, TC.dt_publicacao, TD.bg_diciplina FROM tb_curso TC INNER JOIN tb_professor TP ON TC.cd_prof = TP.cd_prof INNER JOIN tb_diciplina TD ON TC.diciplina = TD.cd_diciplina";
    
    $selectCourses = mysqli_query($conexao, $selectCoursesSQL);

    if(!$selectCourses){
        http_response_code(500);
        die("não foi possivel se conectar ao banco de dados");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/reset.css">
    <title>APOLLO</title>
</head>
<body>
    <header class="page-header">
        <div class="container-header">
            <div class="logo">
                APOLLO
            </div>
    
            <?php 
                if(isset($_SESSION['user'])){
                    echo '
                        <div class="profile-container">
                            <span>Olá! 
                                '.$_SESSION["user"].'
                            </span>
                            <div class="profile-info">
                                <a href="pages/myCourses">Meus cursos</a>
                                <a href="logout.php">Sair</a>
                            </div>
                        </div>';
                }
                else{
                    echo '<a href="pages/login" class="btn-login">LOGIN</a>';
                }
            ?>
        </div>
    </header>
    <main class="container-courses">
        <section>
            <h2 class="subtitle">Principais cursos</h2>
            <div class="grid-courses">
                <?php 
                    if($selectCourses->num_rows > 0){
                        while($course = $selectCourses->fetch_assoc()){
                            $dateFormat = date("d/m/Y", strtotime($course["dt_publicacao"]));
                            $valor = $course["valor"];
                            if($valor == 0){
                                $valor = "grátis";
                            }
                            else{
                                $valor = "R$ {$course["valor"]}";
                            }
                            echo "
                                <div class='card-course'>
                                    <div class='header-card'>
                                        <div class='img-course'>
                                            <div style='background: {$course["bg_diciplina"]}; width: 100%; height: 100%;'></div>
                                        </div>
                                        <span class='date'>{$dateFormat}</span>
                                    </div>
                                    <div class='main-card'>
                                        <span class='discipline'>{$course["nm_diciplina"]}</span>
                                        <h4 class='title-course'>{$course["nm_curso"]}</h4>
                                        <div class='flex'>
                                            <strong class='course-cost'>{$valor}</strong>
                                            <span class='time'>{$course["duracao"]} horas</span>
                                        </div>
                                        <span class='createdBy'>Criado por: {$course["nm_prof"]}</span>
                                    </div>
                                </div>
                            ";
                        }
                    }
                
                ?>
            </div>
        </section>
    </main>
</body>
</html>