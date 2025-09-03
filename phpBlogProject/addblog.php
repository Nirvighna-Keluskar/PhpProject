<?php
include  'db.php';
if(!isset($_SESSION['id'])){
    header("Location:login.php");
}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title=$_POST["title"];
    $content=$_POST["content"];
    $user_id=$_SESSION['id'];
    $image_name="";
    if(!empty($_FILES["image"]["name"])){
        $image_name=$_FILES["image"]["name"];
        move_uploaded_file($_FILES['image']['tmp_name'],"uploads/$image_name");
    }elseif(!empty($_POST['imamge_url'])){
        $image_url = $_POST ['image_url'];
          if (filter_var($image_url, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $image_url)) {
            $image_name = $image_url;
        }    
    }

     $sql = $conn->prepare("INSERT into blogs (title,content,image,user_id) values (?,?,?,?)");
    $sql ->bind_param("sssi",$title,$content,$image_name,$user_id);
    $sql->execute();
    header("location:dashboard.php");
}

?>
<!doctype html>
<html lang="en">
    <head>
        <title>AddBlog</title>
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
            <h1 class="text-center">Add Blog</h1>
        <form action="" method="POST" enctype="multipart/form-data">
             <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control"
                    name="title"
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
                ></textarea>
             </div>

             <div class="mb-3">
                <div class="mb-3">
                <label for="" class="form-label">Choose File</label>
                <input
                    type="file"
                    class="form-control"
                    name="image"
                    id=""
                    aria-describedby="helpId"
                    placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Or Enter Image URL</label>
                    <input
                        type="url"
                        class="form-control"
                        name="image_url"
                        id=""
                        aria-describedby="helpId"
                        placeholder="https://example.com/image.jpg"/>
                </div>
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
