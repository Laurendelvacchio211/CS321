

<?php
include '../include/top.php';
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $phoneErr = $check_listErr = "";
$name = $email = $gender = $comment = $website = $phone = $check_list = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $namelength = $_POST['name'];
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
    elseif (strlen($name) < 3) {
        $nameErr = "Your name is too short";
}
    
  }
}

  
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    
    if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) {
      $phoneErr = "Invalid phone number format";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if(empty($_POST["check_list"])){
        $check_listErr = "Please check one";
        }
  
 elseif (!empty($_POST["submit"])) {
     for( $i = 0; $check_list, $i++;){
     
       if ($check_list < 1){
        $check_listErr = "You need to check at least one box";}
        
        elseif($check_list >= 2){
        $check_list = test_input($_POST["check_list"]);
      }
 }
 }
  
      
  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

<h2>Contact Us</h2>
<link rel='stylesheet' href='styles.css' media='screen'>
<ul class="breadcrumb">
        <li><a href="../index.php">Home</a></li>
       <li>Contact Us</li>

</ul>
<div class ="container4">
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" id="name" name="name" placeholder="Johnny Appleseed" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Phone: <input type="text" id="phone" name="phone" placeholder="xxx-xxx-xxxx" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  E-mail: <input type="text" id="email" name="email" placeholder="xxx@xxxxx.com" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" id="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender"  <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender"  <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  How should we contact you?:
  <input type="checkbox" name="check_list[]" id="checkbox" <?php if (isset($check_list) && $check_list =="phone") echo "checked ";?> value="phone" >Phone
  <input type="checkbox" name="check_list[]"  <?php if (isset($check_list) && $check_list =="email") echo "checked ";?> value="email" >Email
  
  <span class="error">* <?php echo $check_listErr; ?></span>
  <br><br>
  <input type="submit" id="submit" name="submit" value="Submit">  
</form>
</div>


<div class="rightcolumn">
     
            <div class='side'>
            <h2>Want some more History?</h2>
            </div>
      
    <div class="card">
      <img src='../photos/hampton-court-palace.jpg' alt="Hampton Court" style='width:228px; display:block; margin-left:auto; margin-right: auto;'>
      <div class='side'>
      <h3>Hampton Court Gardens</h3>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
      <p style='font-size:11pt;'><b>Learn more about </b><a href ='hampton-court.php' style='font-size:11pt; font-family: tablet-gothic, sans-serif;
            font-weight: 300;
            font-style: normal;'>Hampton Court</a></p>
        </div>
        </div>
        
      <div class="card">
          <img src='../photos/tsar.jpeg' alt="Tsar" style='width:228px; display:block; margin-left:auto; margin-right: auto;'>
      <div class='side'>
      <h3>The King and The Tsar</h3>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium </p>
      <p style='font-size:11pt;'><b>Learn more about </b><a href ='hampton-court.php' style='font-size:11pt; font-family: tablet-gothic, sans-serif;
            font-weight: 300;
            font-style: normal;'>World War II</a></p>
        </div>
        </div> 
    
    </div>

<?php
include '../include/bottom.php';
?>




