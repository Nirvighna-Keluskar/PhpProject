<?php
include 'db.php';
$id = isset ($_GET['id'])?$_GET['id']:null;
if(isset($_GET['id'])){
    $result = $conn -> prepare("select * from blogs where id =?");
    $result -> bind_param('i',$id);
    $result -> execute();
    $user = $result->get_result()-> fetch_assoc();

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $title=$_POST["title"];
        $content=$_POST["content"];
     $image_name="";
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image_name");
    } 
    elseif (!empty($_POST['image_url'])) {
        $image_url = $_POST['image_url'];
        if (filter_var($image_url, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $image_url)) {
            $image_name = $image_url;
        }
    }else{
        $image_name=$user['image'];
    }

        $sql= $conn->prepare("update blogs set title=?,content=?,image=? where id=?");
        $sql->bind_param("sssi",$title,$content,$image_name,$id);
        if($sql->execute()){
            header("Location:dashboard.php");
        }
    }
}

?>


<!doctype html>
<html lang="en">
    <head>
        <title>Edit Blog</title>
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

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
       <div class="container col-md-6 my-5 shadow p-5 rounded-5">
            <h1 class="text-center">Edit Blog</h1>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <input
                    type="hidden"
                    class="form-control"
                    name=""
                    id=""
                    value="<?php echo $user['id']; ?>"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
            
             <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
                    value="<?php echo $user['title']; ?>"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                />
             </div>

             <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea
                    class="form-control"
                    name="content"
                    id=""
                    rows="3"
                ><?php echo $user['content']; ?></textarea>
             </div>
     <?php
        $imagepath="";
        if(filter_var($user['image'], FILTER_VALIDATE_URL)){
            $imagepath= $user['image'];
        }else{
            $imagepath= 'uploads/'.$user['image'];
        }
        ?>

        <img class="card-img-top" src="<?= htmlspecialchars($imagepath) ?>" alt="blog image">

             <div class="mb-3 my-3">
                <label for="" class="form-label">Change File</label>
                <input
                    type="file"
                    class="form-control"
                    name="image"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                />
             </div>

             <div class="mb-3">
                <label for="" class="form-label">Or Enter Image URL</label>
                <input
                    type="url"
                    class="form-control"
                    name="image_url"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""
                />
             </div>
             
             
              <button type="submit" class="btn btn-primary my-3" >
                Submit</button>
         </form>
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
