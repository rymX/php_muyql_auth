
<?php

include('config/db_connect.php');

 $name = $lastname = $email = $password = $hashedpwd= "";
$errors  = array('name'=>'','lastname'=>'','email'=>'', 'password'=> '') ;
if (isset($_GET['submit'])){
   
    if (empty($_GET['email'])){
        $errors['email'] = 'email is require';
    }
    else{
        $email = $_GET['email'];
        if (!filter_var($email , FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = 'email must be a valide email adress';
        }
       // echo htmlspecialchars( $_GET['email']) ;
    }

    if (empty($_GET['password'])){
        $errors['password'] = 'password is require';
    }
    else{
        //echo htmlspecialchars( $_GET['password']) ;

        $password  = $_GET['password'];
        echo $password; 
        echo "<br>";
        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
        echo $hashedpwd ;
        echo "<b>";

    }
    if (empty($_GET['name'])){
        $errors['name'] = 'name is require';
    }
    else{
       //echo htmlspecialchars( $_GET['message']) ;
       $name = $_GET['name'];
    }
    if (empty($_GET['lastname'])){
        $errors['lastname'] = 'lastname is require';
    }
    else{
       //echo htmlspecialchars( $_GET['message']) ;
       $lastname = $_GET['lastname'];
    }

    if (!array_filter($errors)){

            $sql = "INSERT INTO user(name,lastname,email,password,image) VALUES ('$name' ,'$lastname', '$email', '$hashedpwd','assets/picture.png')";
            if (mysqli_query($connection, $sql)){
                header('Location: index.php');  
            }
            else  { echo 'connection error : ' . mysqli_error($connection);
            }

       
    }

}

?>

<!DOCTYPE html>
 <html>
 <?php include('templates/header.php'); ?>
 <section class="container grey-text">
  <h4 class="center"> Register here </h4>
  <div class="center">
    <form class="white" action="add.php" method="GET" >

      <label for="name">name </label>
      <input type="text" name="name" value="<?php echo $name ?>">
      <div class="red-text"> <?php echo $errors['name']; ?> </div>

      <label for="lastname">lastname </label>
      <input type="text" name="lastname" value="<?php echo $lastname ?>">
      <div class="red-text"> <?php echo $errors['lastname']; ?> </div>

      <label for="email"> e-mail </label>
      <input type="text" name="email" value="<?php echo $email?>"> 
      <div class="red-text"> <?php echo $errors['email']; ?> </div>

      <label for="password">password</label>
      <input type="password" name="password" value="<?php echo $password ?>">
      <div class="red-text"> <?php echo $errors['password']; ?> </div> 

      
      <div class="center">
      <input type="submit" name="submit" value="Sign Up" class="btn brand z-depth-0">
      </div>

      <a href="index.php" class=" brand-text"> Sign IN</a> 
    </form>
    </div>
 </section>

 <?php include('templates/footer.php'); ?>
  

 </html>