<?php 
    include "../../database/database.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        if (create($conexao)){
            header('Location: lista.php');
        }
    }
    else {
        http_response_code(400);
        echo "Bad request (400)  ";
        echo "Você usou o método de envio errado para esta requisição. Por favor, use o método correto (GET, POST, PUT ou DELETE) de acordo com o tipo de operação que você deseja realizar.";
    }

    function create($conexao){
        $courseName = $_POST["nomeCurso"];
        $courseCategory = $_POST["categoria"];
        $courseDuration = $_POST["duracao"];
        $courseCost = $_POST["valor"];
        $teacherCode = $_POST["teacherCode"];
    
        date_default_timezone_set('America/Sao_Paulo');
        $date = date("Y-m-d", strtotime(date("Y-m-d")));
        
        if(empty($courseName) || empty($courseCategory) || empty($courseDuration) || empty($courseCost) || empty($teacherCode)){
            $_SESSION["message"] = array(
                "message" => "Por favor, preencha todos os campos antes de enviar o formulário.",
                "type" => "error"
            );
            header("Location: ./");
            exit;
        }
        else if(strlen($courseName) > 60){
            $_SESSION["message"] = array(
                "message" => "O nome do curso não pode ter mais de 60 caracteres. Por favor, digite um nome mais curto e tente novamente.",
                "type" => "error"
            );
            header("Location: ./");
            exit;
        }
        
        $sqlInsert = "INSERT INTO tb_curso (nm_curso, duracao, diciplina, valor, cd_prof, dt_publicacao) value ('{$courseName}', '{$courseDuration}', '{$courseCategory}', '{$courseCost}', '{$teacherCode}', '{$date}')";
        $insertDataBase = mysqli_query($conexao, $sqlInsert);
    
        if(!$insertDataBase){
            http_response_code(400);
            die();
        }
    
        $_SESSION["message"] = array(
            "message" => "Parabéns! Você acabou de criar o seu curso com sucesso!
            Agora você pode compartilhar o seu conhecimento com o mundo e inspirar outras pessoas a aprenderem mais sobre o seu tema.",
            "type" => "sucess"
        );
        header("Location: ../myCourses");
    }
?>