<?php 
    include "../database/database.php";

    if(empty($_GET["code"])){
        http_response_code(400);
        exit;
    }
    $dataCourse = [];
    
    $parm = $_GET["code"];
    $sql = "SELECT TC.cd_curso, TC.nm_curso, TC.duracao, TC.valor, TP.nm_prof, TC.dt_publicacao, TD.nm_diciplina, TD.bg_diciplina
            FROM tb_curso TC
            INNER JOIN tb_professor TP
            ON (TC.cd_prof = TP.cd_prof) 
            INNER JOIN tb_diciplina TD
            ON (TC.diciplina = TD.cd_diciplina)
            WHERE cd_curso = '{$parm}';
        ";

    $query = mysqli_query($conexao, $sql);

    if($query->num_rows > 0){
        while($data = $query->fetch_assoc()){
            array_push($dataCourse, [
                "cd_curso" => $data["cd_curso"],
                "name" => $data["nm_curso"],
                "duracao" => $data["duracao"],
                "valor" => $data["valor"],
                "cd_prof" => $data["nm_prof"],
                "diciplina" => $data["nm_diciplina"],
                "background" => $data["bg_diciplina"],
                "dt_publicacao" => date("d/m/Y", strtotime($data["dt_publicacao"]))
                ]
            );
        }
    }
    else{
        array_push($dataCourse, ["error" => "Course Not Found"]);
    }

    $json = json_encode($dataCourse[0]);
    echo $json;
?>