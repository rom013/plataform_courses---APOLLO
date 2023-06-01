<?php 
    include "../../database/database.php";
    
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        if (deleteCourse($conexao)){
            header('Location: lista.php');
        }
    }
    else {
        http_response_code(400);
        echo "Bad request (400)  ";
        echo "Você usou o método de envio errado para esta requisição. Por favor, use o método correto (GET, POST, PUT ou DELETE) de acordo com o tipo de operação que você deseja realizar.";
    }


    function deleteCourse($conexao){
        $code = $_POST["code"];
    
        $deleteSQL = "DELETE FROM tb_curso WHERE cd_curso = {$code}";
        $queryDelete = mysqli_query($conexao, $deleteSQL);
    
        if(!$queryDelete){
            die("ocorreu algum erro durante a ação de DELETE");
        }
    
        header("Location: ./");
    }
?>