<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="/Public/css/user/user.css">
</head>
<body>
  <h1>Registration Form</h1>
  <form action="/user/register" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Register</button>
  </form>
 <div class="login"> Already an user ? <a href = "/user/login" class="login-btn">Login</a></div>

</body>
</html>
