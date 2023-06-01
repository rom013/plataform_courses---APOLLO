<?php 
    $bdServidor = '127.0.0.1:3312';
    $bdUsuario = 'root';
    $bdSenha = '';
    $bdBanco = 'plataform_courses';
    try {
        $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
    } catch (Exception $th) {
        echo "ERRO 500";
        echo "Problemas para conectar no banco.";
        die();
    }
?>
