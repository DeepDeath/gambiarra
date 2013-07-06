gambiarra
=========

É, ou não é uma gambiarra?

<?php
            session_start();
            extract($_POST);
            require("./php/conn.php");
            if(!isset($_SESSION['user@site'])){
                include ("./pages/home.html");
                if(isset($_POST['subLogin'])){
                $query = mysql_query("SELECT username FROM users WHERE username = '$userLogin' and password = '$passLogin'");
                if(mysql_num_rows($query) == 1){
                    while ($row = mysql_fetch_array($query)) {
                        $_SESSION['user@site'] = $row['username'];
                        header("Location: ./");
                    }
                }  else {
                    header("Location: errorLogin.php");
                    }
                }
                if(isset($_POST['subReg'])){
                    if(strlen($nameReg) > 6){
                        if(preg_match("/^[a-zA-z0-9_]{4,24}$/", $userReg)){
                            if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $emailReg)) {
                                if($passReg === $conPassReg){
                                    $query = mysql_query("INSERT INTO users (name,username,email,password,sex) VALUES ('$nameReg','$userReg','$emailReg','$passReg','$sexReg')");
                                    $_SESSION['user@siteRegister'] = $userReg;
                                }else { echo ("<script> alert('As senhas não sai iguais'); </script>");}
                            }else{
                                echo ("<script> alert('Email inválido'); </script>");
                            }
                        } else { echo ("<script> alert('Usuário deve contar apeanas letras numeros e _');</script>"); }
                    }else { echo ("<script> alert('Nome menor que 6 caracteres'); </script>"); }
                }
            }else {
                include ("./pages/profile.php");
            }
        ?>
