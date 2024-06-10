<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert!!</title>
</head>
<body>
    <?php
    //header("location: index.php");
    ?>
    <script>
       alert("Please remove the config word from the URL.");
       <?php
       header("location: ../index.php");
        ?>
    </script>

</body>
</html>