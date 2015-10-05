 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Canbert | Admin</title>

    <style type='text/css'>
        body {
            text-align: center;
        }
        label, input {
            display:block;
            margin:10px auto;
        }
     
    </style>

</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="/admin/validate">
        <label for="password">Password</label>
        <input type="password" name="password"/>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>