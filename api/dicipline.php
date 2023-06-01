<?php 
    include "../database/database.php";

    $sql = "SELECT * FROM tb_diciplina";
    $query = mysqli_query($conexao, $sql);
    $array = [];


    if(!$query){
        http_response_code(400);
        exit;
    }

    if($query->num_rows > 0){
        while($data = $query->fetch_assoc()){
            array_push($array, [
                "id" => $data["cd_diciplina"],
                "nm_diciplina" => $data["nm_diciplina"]
            ]);
        }
    }

    $json = json_encode($array);
    echo $json; 
?>