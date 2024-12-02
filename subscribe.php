<?php
session_start();

include('connection.php');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];

  //check email
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
    $sql = "SELECT email FROM subscriptions WHERE email = '$email'";
    $query = $dbh->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
      echo "<script>alert('You have already subscribed!');</script>";
      echo "<script>window.location.href ='index.html'</script>";
    } else {
      //All test passed
      $email_valid = true;
    }
  }

  if ($email_valid == true) {
    $sql = "INSERT INTO subscriptions(email) VALUES(:email)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    if ($query->execute()) {
      echo "<script> alert('subscription successful!') </script>";
      echo "<script> window . location . href = history.go(-1) </script>";
    }
  }
}
