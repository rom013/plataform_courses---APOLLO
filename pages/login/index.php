<!-- by Romullo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login.css">
    <title>Imersão JS</title>
</head>
<body>
    <main class="main-signup">
        <a href="http://localhost/atv_banco_cursos" style="position:absolute; left: 64px; top:64px; text-decoration: none">
            <h1 style="color:#a3e635;font-size: 3rem;">APOLLO</h1>
        </a>
            
            <section class="container-content">
            <h1>De seus primeiros passos na área de <span>programação</span></h1>
            <p>
                <!-- by Romullo -->
                Aprenda a programar com a APOLLO, a plataforma de cursos de programação que te leva ao espaço. Aqui você encontra cursos de Fluter, Java, Node.JS e muito mais, com professores experientes e projetos práticos. Não perca tempo e embarque nessa jornada rumo ao futuro da tecnologia.
            </p>
        </section>
        <div class="container-signup">
            <h1 class="title" id="titleForm">Cadastro</h1>
            <form action="validate.php" method="POST" class="form-signup" id="formSignup">
                <?php 
                    session_start();
                    $a;
                    if(isset($_SESSION["error"])){
                        $a = $_SESSION["error"];
                        echo "<span class='error'>".$_SESSION["error"]."</span>";
                    }
                ?>
                <!-- by Romullo -->
                <input 
                    type="text" name="username" placeholder="Username" 
                    class="<?php echo (isset($a) && $a == 0) ? 'error-input' : '' ?>"
                >
                <input 
                    type="text" name="email" placeholder="Email"
                    class="<?php echo (isset($a) && $a == 1) ? 'error-input' : '' ?>"
                >
                <div class="container-pass">
                    <input 
                    type="password" name="password" placeholder="Password" id="password" onChange="handle()"
                    class="<?php echo (isset($a) && ($a == 3 || $a == 4 || $a == 5 || $a == 2)) ? 'error-input' : '' ?>"
                >
                    <div>
                        <span id="letra">Letra</span>
                        <span id="numero">Número</span>
                        <span id="simbolo">Símbolo</span>
                        <span id="caracteres">8 caracteres</span>
                    </div>
                </div>

                <a onClick="handleForm(true)" class="link-form">
                    já possui uma conta? entrar
                </a>
    
                <input type="submit" value="cadastrar" class="btn-sign">
            </form>

            <form action="validateLogin.php" method="POST" class="form-signup" id="formLogin" style="display: none">
                <?php 
                    $a;
                    if(isset($_SESSION["error"])){
                        $a = $_SESSION["error"];
                        echo "<span class='error'>".$_SESSION["error"]."</span>";
                    }
                ?>
                <!-- by Romullo -->
                <input 
                    type="text" name="email" placeholder="Email"
                    class="<?php echo (isset($a) && $a == 1) ? 'error-input' : '' ?>"
                >
                
                <input 
                    type="password" name="password" placeholder="Password" id="password" onChange="handle()"
                    class="<?php echo (isset($a) && ($a == 3 || $a == 4 || $a == 5 || $a == 2)) ? 'error-input' : '' ?>"
                >


                <a onClick="handleForm(false)" class="link-form">
                    ainda não possui uma conta? cadastrar
                </a>
    
                <input type="submit" value="Entrar" class="btn-sign">
            </form>
        </div>
    </main>
    <a href="https://github.com/rom013" target="_blank" class="make-wather">@rom013</a>
    <?php 
        unset($_SESSION["error"]);
    ?>
    <script src="script.js"></script>
    <script>
        const formSignup = document.querySelector("#formSignup")
        const formLogin = document.querySelector("#formLogin")
        const titleForm = document.querySelector("#titleForm")
        function handleForm(x) {
            if (x || x == "true") {
                formSignup.style.display = "none"
                formLogin.style.display = "flex"
                titleForm.textContent = "Login"
            }
            else {
                formSignup.style.display = "flex"
                formLogin.style.display = "none"
                titleForm.textContent = "Cadastro"
            }
        }
    
    </script>
</body>
</html>

<!-- by Romullo -->