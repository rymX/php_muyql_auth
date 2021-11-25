
<?php
include('config/db_connect.php');
session_start();
$user_id = $_SESSION['user_id'] ?? "";


if(isset($user_id)){

  $id= $user_id ;
  $sql ="SELECT name, lastname, email, image  FROM user where id = '$id'";
  $res = mysqli_query($connection, $sql);
  $user= mysqli_fetch_assoc($res);
  
  mysqli_free_result($res);
  //mysqli_close($connection);
  }
  if (isset($_GET['sign_out'])){
    session_unset();
   // unset($_SESSION['user_id']);
    header('location : index.php');
  }

if (isset($_GET['submit'])){
$id_to_delete= $_GET['delete'] ;
$sql="DELETE FROM user where id = '$id_to_delete'";
if( mysqli_query($connection , $sql)){
  header('location: index.php');
}
else 
{
  echo 'query error' . mysqli_error($connection); 
}

}

if ( isset($_POST['upload'])){
 
  $file = $_FILES['image'];
  $fileName=$_FILES['image']['name'];
 
  $fileTmp_name=$_FILES['image']['tmp_name'];
 
  $fileError=$_FILES['image']['error'];

  $Ext = explode('.' , $fileName);

  $fileExt = strtolower(end($Ext));

  $allowd = ['png','jpg','jpeg'];
    if(in_array($fileExt , $allowd)) {
      if ($fileError ===0){
        $fileDestination= 'assets/'.$fileName ;
        move_uploaded_file($fileTmp_name , $fileDestination);

        $sql="UPDATE user SET image ='$fileDestination' WHERE id = '$user_id'";
        $result = mysqli_query($connection , $sql);
        echo 'test';
      }
    }
  
}

?>

<html>
 <?php include('templates/header.php') ?>

            <h4 class="center grey-text"> Welcome</h4>
            <div style="max-width :500px" class="container">
         <div class="card z-depth-0">
         <img src= "<?php echo $fileDestination ?? $user['image'] ?>"" class="picture">

         <form class="update" action="profile.php" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" id="image">
         <input type="submit" name="upload" value="update picture">
         </form>
         
         <div class="card-content center">
                            
           <h4>
            <?php echo htmlspecialchars($user['name'] ?? 'User name'); ?>
            <hr>
            <?php echo htmlspecialchars($user['lastname'] ?? 'User lastname');  ?>
            
            </h4>
            <div> <?php echo htmlspecialchars($user['email'] ?? 'User email' )  ;?> </div>
            </div>
            <div class="card-action right-align ">
          
          <form action="profile.php" method="GET">
          <input  type="submit" class="btn brand z-depth-0" name="sign_out" value="SIGN OUT">
          </form>
            

              <form action="profile.php" methode="GET">
              <input type="hidden" name="delete" value="<?php echo $id?>">
              <input class="btn danger z-depth-0" type="submit" name="submit" value="DELETE ACCOUNT">
              
              </form>
            



              </div>
           </div>
       </div>


<?php include('templates/footer.php') ?>
</html>
               
                

            