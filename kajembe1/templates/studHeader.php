<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .brand{
        background-color:cbb09c !important;
    }
    .brand-text{
        color:blue !important;
    }
    form{
        max-width:460px;
        margin:20px auto;
        padding:20px;
    }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            //check this!!!!
            <a href="../../welcome.php" class="brand-logo brand-text">KAJEMBE SCHOOL - Student Dashboard</a>
        </div>
    </nav>
    <?php
        echo "<h5 class='center'>WELCOME </h5>";//.$stud['studName']." </h5>";
    ?>
    <!-- This div clossed in footer.php-->
    <div class="container d-flex justify-content-between ">
    <div class="side-bar bg-dark center p-2 ">
        <a href="logout.php" class="btn btn-warning">Logout</a><br>
        <!--CHECK ON THIS LIKE SERIOUSLY-->
        <h5 class="btn"><a href="../blogs/create.php" class="text-light text-deoration-none">Create Post</a> </h5>
    </div>
</html>