<?php
  
  require_once './data/orm.php';
  require_once 'user.php';
  $error = null;
  
  $orm = new ORM(); 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $error = "Email is required";
    }elseif (!str_contains($_POST["email"], "@")) {
      $error = "Invalid email format";
    }else if (empty($_POST["password"])) {
      $error = "Password is required";
    } else {
    //   $statement = $connection->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    //   $statement->bindParam(":email", $_POST["email"]);
    //   $statement->execute();
        $user = new Users();
        $user->email = $_POST["email"];
        $user = $orm->findBy($user,'email', $user->email);

      // Check if the credentials are valid
      if (sizeof($user) == 0) {
        $error = "Invalid email or password";
      }else
        $user = $user[0];
        // Check if the password is correct
        if(!password_verify($_POST["password"], $user['password'])){
          $error = "Invalid credentials";
        }else{
            session_start(); //Si tu no tienes una sesion asociada a tu navegador, esta funcion crea una sesion en el servidor
            unset($user['password']); //Elimina la contraseña del usuario (por seguridad)
        
            $_SESSION["user"] = $user; //Coockie
          
            header("Location: home.php");
        }
      }
      
    }
    

?>