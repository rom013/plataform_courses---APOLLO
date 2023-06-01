<!-- by Romullo -->
<?php 
    session_start();
    include "../../database/database.php";

    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $regexNumber = "/[0-9]/";
    $regexLetter = "/[a-zA-Z]/";
    $regexSymbol = "/[@#!$%¨&*()_+=-]/";
    
    $sql = "select * from tb_professor where email_prof = '" .$email. "'";
    $query = mysqli_query($conexao, $sql);
    
    try {
        
        if($query->num_rows > 0){
            throw new Exception("usuario já está em uso");
        }
        if(empty($username) || empty($email) || empty($password)){
            throw new Exception("campo vazio");
        }
        if(strlen($username) < 4){
            throw new Exception(0); //"campo usuario muito curto"
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception(1); // campo email invalido"
        }        
        
        if(strlen($password) < 8){
            throw new Exception(2); // "senha muito curta"
        }
        if(!preg_match($regexLetter, $password)){
            throw new Exception(3); // "senha letra"
        }
        if(!preg_match($regexNumber, $password)){
            throw new Exception(4); // "senha numero"
        }
        if(!preg_match($regexSymbol, $password)){
            throw new Exception(5); // "senha simbolo"
        }
        $_SESSION["data"] = [$username, $email];
        
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $insert = "INSERT INTO `tb_professor` (`nm_prof`, `senha_prof`, `email_prof`) VALUES ('".$username."', '".$password."', '".$email."')";
        $insertDataBase = mysqli_query($conexao, $insert);

        header("Location: ./");
    } catch (Exception $res) {
        $_SESSION["error"] = $res->getMessage();
        header("Location: index.php");
    }
?>

<!-- by Romullo -->