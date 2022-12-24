<?php 
session_start();

$username = "";
$email = "";
$errors = array();

//connect to the database
$db = mysqli_connect('localhost','root','','masterpiece');


// try {
//     // start connection with database
//     $conn = new PDO("mysql:host=$servername;dbname=masterpiece", $username, $email);
  
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //select type error
   
   
//     echo "Database created successfully<br>";
    
//   } catch(PDOException $e) {
//     echo $sql . "<br>" . $e->getMessage();
//   }



//register user
if(isset($_POST['reg_user'])){
    //receive all input values from the form
    $username = mtsqli_real_escape_string($db, $_POST['username']);
    $email = mtsqli_real_escape_string($db, $_POST['email']);
    $password_1 = mtsqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mtsqli_real_escape_string($db, $_POST['password_2']); 

    //validation
    if(empty($username)){ array_push($errors,"Username is required");}
    if(empty($email)){ array_push($errors,"Email id required");}
    if(empty($password_1)){array_push($errors,"passwprd is required");}
    if($password_1 != $password_2){
        array_push($errors,"The tow passwords do not match");
    }


    //check the database and make sure a user does not exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db,$user_check_query);
    $user = mysql_fetch_assoc($result);

    if ($user){//if user exist
      if ($user['username'] === $username){
        array_push($errors, "Username already exists");
      }

      if ($user['email'] === $email){
        array_push($errors, "Email already exists");
      }
    }

    //if every thing is done and there is no errors
    if (count($errors) == 0){
        $password = md5($password_1);//encrypt the pass before saveing in the database

        $query = "INSERT INTO users (username, email, password)
                VALUE('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "you are now logged in";
        header('location: index.php');
    }
}


//login user
if (isset($_POST['login_user'])){
    $username = mtsqli_real_escape_string($db, $_POST['username']);
    $password = mtsqli_real_escape_string($db, $_POST['password']);

    if(empty($username)){
        array_push($errors,"Username is required");
    }
    if(empty($password)){
        array_push($errors,"Password is required");
    }

    if(count($errors) == 0){
        $password =  md5($password)//encrypt the pass before saveing in the database
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            $_SESSION['seccess'] = "You are now logged in";
            header('location: index.php');
        }else{
            array_push($errors, "Wrong username/passwoed combination");
        }
    }
}

?>