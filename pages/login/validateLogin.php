<?php 
    session_start();
    include "../../database/database.php";

    $email = $_POST["email"];
    $pass = $_POST["password"];
    $a = mysqli_query($conexao, "select * from tb_professor where email_prof = '" .$email. "'");
    
    if(empty($email) || empty($pass)){
        header('Location: ../login');
    }

    if($a->num_rows > 0){
        while($dado = $a->fetch_assoc()) { 
            if(password_verify($pass, $dado['senha_prof'])){
                $_SESSION["user"] = $dado['nm_prof'];
                $_SESSION["cd_user"] = $dado['cd_prof'];
                echo $dado["cd_prof"];
                header("Location: http://localhost/atv_banco_cursos/");
            }
            else{
                $_SESSION["error"] = "email ou senha invalido";
                header("Location: ../login");
            }
        }
    }
    else{
        $_SESSION["error"] = "email ou senha invalido";
        header("Location: ../login");
    }
?>