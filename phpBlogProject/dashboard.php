<?php
include "db.php";
if(!isset($_SESSION["id"])){
    header("location:login.php");
}
$user_id = $_SESSION["id"];
$result = $conn -> query("SELECT blogs.*, uname from blogs join user on blogs.user_id=user.id");

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <style>
        .card:hover{
            transform: scale(1.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
       body {
            background: linear-gradient(135deg, #e3e3e3, #cfcfcf);
            color: #333;
        }


    </style>

    <body>
        <header>
           <nav class="navbar navbar-expand-lg navbar-dark py-3 shadow-sm" style="background: linear-gradient(to right, #43cea2, #185a9d);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Dashboard</a>

    <div class="ms-auto d-flex gap-2">
      <a href="addblog.php" class="btn btn-light text-dark">Add Blog</a>
      <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>


        </header>
        <main>

           

<div class="container shadow p-4">
    <div class="row">
    <?php while($row = $result->fetch_assoc()){?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
            <?php
            if(filter_var($row['image'],FILTER_VALIDATE_URL)){
                $imagepath=$row['image'];
            }else{
                $imagepath='uploads/'.$row['image'];
            }
            ?> 

            <img class="card-img-top" src="<?= htmlspecialchars($imagepath) ?>" alt="blog image">
            <div class="card-body">
                <small>By: <?=$row['uname'] ?> | <?=$row['created_at']?></small>
                <h4 class="card-title"><?= $row["title"]?></h4>
                <p class="card-text"><?= $row["content"]?></p>
            </div>

            <?php if($_SESSION['id']==$row['user_id']){?>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-primary" href="editblog.php?id=<?= $row["id"]?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $row["id"]?>">Delete</a>
                </div>
            <?php }?>
            </div>
        </div>
    <?php }?>
    </div>
</div>

  
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
