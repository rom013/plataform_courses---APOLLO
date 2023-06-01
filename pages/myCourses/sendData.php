<?php 
    include "../../database/database.php";

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        if (updateCourse($conexao)){
            header('Location: lista.php');
        }
    }
    else {
        http_response_code(400);
        echo "Bad request (400)  ";
        echo "Você usou o método de envio errado para esta requisição. Por favor, use o método correto (GET, POST, PUT ou DELETE) de acordo com o tipo de operação que você deseja realizar.";
    }

    function updateCourse($conexao){
        $title = $_POST["title-course"];
        $discipline = $_POST["discipline"];
        $cost = $_POST["course-cost"];
        $time = $_POST["hours"];
        $codeCourse = $_POST["code"];
    
        $sql = "UPDATE tb_curso SET nm_curso = '{$title}', duracao = '{$time}', diciplina = '{$discipline}',  valor = '{$cost}' WHERE cd_curso = '{$codeCourse}'";
    
        $update = mysqli_query($conexao, $sql);
        if($update){
            header("Location: ./");
        }
        else{
            echo "Ocorreu um erro durante o processo";
        }
    }
?>