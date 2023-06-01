<!DOCTYPE html>
<html lang="pt-BR">
<?php 
    include "../../database/database.php";
    session_start();

    if(!isset($_SESSION["user"])){
        header("Location: ../../");
    }
    $codeUser = $_SESSION["cd_user"];
    $sqlSelectDicipline = "SELECT * FROM tb_diciplina"; 

    try {
        $query = mysqli_query($conexao, $sqlSelectDicipline);
    } catch (Exception $th) {
        echo $th->getMessage();
    }


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/addCourse.css">
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
                    <a href="../myCourses">Meus cursos</a>
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
            <form action="./createNewCourse.php" method="POST" class="container-form">
                <input type="hidden" name="teacherCode" value="<?php echo $_SESSION["cd_user"]  ?>">
                <section class="section-form">
                    <div class="info-section">
                        <strong>Nome do curso</strong>
                        <p>
                            Neste campo, você deve digitar o nome do curso que deseja criar na plataforma. Escolha um nome claro e informativo, que descreva o conteúdo e o objetivo do seu curso. O nome do curso pode ter até 50 caracteres.
                        </p>
                    </div>
                    <div class="container-input">
                        <input type="text" name="nomeCurso" id="nomeCurso" placeholder="Crindo flap bird em Javascript">
                    </div>
                </section>
                <span class="line-hr"></span>
                <section class="section-form">
                    <div class="info-section">
                        <strong>Categoria</strong>
                        <p>
                            Este campo é para você inserir a categoria do curso que você quer criar. Escolha a categoria que melhor descreve o conteúdo do seu curso.
                        </p>
                    </div>
                    <div class="container-input">
                        <select name="categoria" id="categoria">
                            <?php 
                                if($query->num_rows > 0){
                                    while($dicipline = $query->fetch_assoc()){
                                        echo "<option value='{$dicipline["cd_diciplina"]}'>{$dicipline["nm_diciplina"]}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </section>
                <span class="line-hr"></span>
                <section class="section-form">
                    <div class="info-section">
                        <strong>Duração <small style="color: #71717a">(horas)</small></strong>
                        <p>
                            Neste campo, você deve informar a duração total do curso que você quer criar, em horas. A duração do curso ajuda os alunos a planejarem o seu tempo de estudo.
                        </p>
                    </div>
                    <div class="container-input">
                        <input type="number" name="duracao" id="duracao" placeholder="48">
                    </div>
                </section>
                <span class="line-hr"></span>
                <section class="section-form">
                    <div class="info-section">
                        <strong>Valor</strong>
                        <p>
                            Digite o valor do curso que você deseja criar em reais (R$). Esse valor será o preço cobrado dos alunos que se inscreverem no seu curso.
                        </p>
                    </div>
                    <div class="container-input">
                        <div>
                            <span>R$</span>
                            <input type="number" step="any" name="valor" id="valor" placeholder="00,00">
                        </div>

                        <span class="info-input">Digite 00,00 para adcionar um curso grátis*</span>
                    </div>
                </section>

                <button type="submit" class="btn-create-courese">
                    CRIAR
                </button>
            </form>
        </section>
    </main>

    <script>
        setTimeout(()=>{
            document.querySelector(".error").remove()
        }, 10000)   
    </script>
</body>

</html>