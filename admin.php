<!DOCTYPE html>
<html lang="en">
<head>
<script> 
// This function checks the entered text is the same as the password
            function VALIDATION() { 
                var pswd = "Admin2020"
                var pword =  
                    document.forms["memberform"]["pword"];
                    if (pword.value !== pswd) { 
                    window.alert("Password was wrong. Please Try again!"); 
                    pword.focus(); 
                    return false; 
                    }
                    return true;
            }
        </script> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Back to homepage</a> <br>
    <form action="query.php" method="post" name="memberform" id="memberform" onsubmit="return VALIDATION()">
        <label for="pword">Password:</label>
        <input type="text" name="pword" id="pword" size = "30"><br><br>
        
        <input type="submit" value="submit">
        <input type="reset" value="reset">
    </form> <br><br>
</body>
</html>