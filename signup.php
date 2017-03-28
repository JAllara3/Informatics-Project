<!DOCTYPE html>
    <html>
        <head>
            <title>Customer Signup Page</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
            
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
            integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            
            <link rel="stylesheet" type="text/css" href="style.css" />
        </head>
        <body>
            <div class="container login">
                <form action="signup.php" method="post" class="form-signin" id = "login_form" >
                    <h2 class="form-signin-heading">Customer Signup</h2>
                    <input type="text" name="username" size="20" placeholder="Username"></br></br>
                    <input type="email" name ="email" size="20" placeholder="Email"></br></br>
                    <input type="password" name="password" size="20" placeholder="Password"></br></br>
                    <input type="password" name="password" size="20" placeholder="confirm password"></br></br>
                    <input type="submit" value="Sign Up" class="btn btn-large btn-primary">&nbsp
                    <a href="CLogin.php">back to login</a>
                </form>
            </div>
        </body>
    </html>