<!-- Update the database based off an ID number (from a query) 
-->
<?php include "db.php"; include "functions.php";
if(isset($_POST['submit'])) {
updateTable();    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MySQL Login with bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
      <div class="col-sm-6">
         <h1 class="text-center">Update</h1>
          <form action="login_update.php" method="post">
              <div class="form-group">
                 <label for="username">Username</label>
                  <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                 <label for="password">Password</label>
                  <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group">
                  <select name="id" id="">
                     <?php
                        showAllData();
                      ?>
                  </select>
              </div>
              <input class="btn btn-primary" type="submit" name="submit" value="Update">
          </form>
      </div>
  </div>
</body>
</html>
