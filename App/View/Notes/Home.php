<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes Maker App</title>
  <link rel="stylesheet" href="/Public/css/notes/nav.css">
  <link rel="stylesheet" href="/Public/css/notes/home.css">
  <!-- js file to send post and get requests asynchronously -->
  <script defer src="/Public/js/addNote.js"></script>
</head>
<body>
<nav>
  <h1>Notes App</h1>
  <ul>
    <li><a href="/note/home">Home</a></li>
    <li><a href="/user/logout">Logout</a></li>
  </ul>
</nav>
<div class="form-container" >
  <form id = "myForm">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter title">

    <label for="body">Body:</label>
    <textarea id="body" name="body" placeholder="Enter note"></textarea>

    <button type="submit">Add Note</button>
  </form>
</div>
<div id="card-container">

</div>

</body>
</html>
