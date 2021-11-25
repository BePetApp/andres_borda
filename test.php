<?php 
include_once 'Controllers/MessageController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/fe08a25bb7.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="Views/css/style.css">
    <title>Blog</title>
</head>
<body class="bg-gray-800">
<?php Messages::showMessage()?>
</body>
</html>

