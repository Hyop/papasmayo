<?php

    //Conecto con la base de datos
    $conn = mysql_connect("localhost","root","mysql");
    //Selecciono la BBDD
    mysql_select_db("EranovaBD",$conn); 

    //Primero tengo que ver si el usuario está memorizado en una cookie
    if (isset($_COOKIE["id_usuario_dw"]) && isset($_COOKIE["marca_aleatoria_usuario_dw"])){
       //Tengo cookies memorizadas
       //además voy a comprobar que esas variables no estén vacías
       if ($_COOKIE["id_usuario_dw"]!="" || $_COOKIE["marca_aleatoria_usuario_dw"]!=""){
          //Voy a ver si corresponden con algún usuario
          $ssql = "select * from usuario where id_usuario=" . $_COOKIE["id_usuario_dw"] . " and cookie='" . $_COOKIE["marca_aleatoria_usuario_dw"] . "' and cookie<>''";
          $rs = mysql_query($ssql);
          if (mysql_num_rows($rs)==1){
             echo "<b>Tengo un usuario correcto en una cookie</b>";
             $usuario_encontrado = mysql_fetch_object($rs);
             echo "<br>Eres el usuario número " . $usuario_encontrado->id_usuario . ", de nombre " . $usuario_encontrado->usuario;
             //header ("Location: contenidos_protegidos_cookie.php");
          }
       }
    }

    if ($_POST){
       //es que estamos recibiendo datos por el formulario de autenticación (recibo de $_POST)

       //debería comprobar si el usuario es correcto
       $ssql = "select * from usuario where usuario = '" . $_POST["usuario"] . "' and clave='" . $_POST["clave"] . "'";
       //echo $ssql;
       $rs = mysql_query($ssql);
       if (mysql_num_rows($rs)==1){
          //TODO CORRECTO!! He detectado un usuario
          $usuario_encontrado = mysql_fetch_object($rs);
          //ahora debo de ver si el usuario quería memorizar su cuenta en este ordenador
          if ($_POST["guardar_clave"]=="1"){
             //es que pidió memorizar el usuario
             //1) creo una marca aleatoria en el registro de este usuario
             //alimentamos el generador de aleatorios
             mt_srand (time());
             //generamos un número aleatorio
             $numero_aleatorio = mt_rand(1000000,999999999);
             //2) meto la marca aleatoria en la tabla de usuario
             $ssql = "update usuario set cookie='$numero_aleatorio' where id_usuario=" . $usuario_encontrado->id_usuario;
             mysql_query($ssql);
             //3) ahora meto una cookie en el ordenador del usuario con el identificador del usuario y la cookie aleatoria
             setcookie("id_usuario_dw", $usuario_encontrado->id_usuario , time()+(60*60*24*365));
             setcookie("marca_aleatoria_usuario_dw", $numero_aleatorio, time()+(60*60*24*365));
          }
          echo "Autenticado correctamente";
          //header ("Location: contenidos_protegidos_cookie.php");

       }else{
          echo "Fallo de autenticación!";
          echo "<p><a href='prueba-cookies.php'>Volver</a>";
       }

    }else{
        
    }
?>