<?php
//using the strict mode (declare(strict_types=1)) -- this statement should in the first line
declare(strict_types=1);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP With Security in Mind</title>
</head>
<body>
<?php

$nameErr = $emailErr = $commentsErr = " ";
$name = $email = $comments = " ";

if($_SERVER["REQUEST_METHOD"] == "post"){
    if (empty($_POST['name'])) {
        $nameErr = "Name is required.";
    } else {
        $name = validate_data($_POST['name']);

        if(!preg_match("/^[a-zA-Z-']*$/", $name)){
            $nameErr = "Only letters and white spaces are allowed.";
        }
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required.";
    } else {
        $email = validate_data($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format.";
        }
    }
    if (empty($_POST['comment'])) {
        $commentsErr = "Comments are required.";
    } else {
        $comments = validate_data($_POST['comment']);
    }
}

function validate_data($data){
    stripslashes($data);        
    trim($data);
    htmlspecialchars($data);
}

?>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Please supply input fields.</h1>
        Name: <input type="text" name="uname"><br>
        <span class="error">* <?php echo $nameErr; ?></span><br>
        Email: <input type="text" name="email"><br>
        <span class="error">* <?php echo $emailErr; ?></span><br>
        Comments: <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
        <button type="submit">Submit</button>
     </form>
</body>
</html>