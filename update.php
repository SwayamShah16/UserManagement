<?php
include 'db.php';
session_start();

if(isset($_GET["p_name"]))
    $pname = $_GET["p_name"];

$sql = $conn -> prepare("select p_name,category,price,quantity from products where p_name=?");
$sql -> bind_param("s",$pname);
$sql -> execute();
$output = $sql -> get_result();
$user = $output -> fetch_assoc();


if($_SERVER["REQUEST_METHOD"]==="POST"){
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = $conn -> prepare("update products set category=?,price =?,quantity=? where p_name=?;");
    $sql -> bind_param("siis",$category,$price,$quantity,$pname);
    if($sql -> execute()){
        header("Location:home.php");
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div
                class="container"
            >
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="pname"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?= $user['p_name'] ?>"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Category</label>
                        <input
                            type="text"
                            class="form-control"
                            name="category"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?= $user['category'] ?>"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Price</label>
                        <input
                            type="text"
                            class="form-control"
                            name="price"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?= $user['price'] ?>"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Quantity</label>
                        <input
                            type="text"
                            class="form-control"
                            name="quantity"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?= $user['quantity'] ?>"
                        />
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update
                    </button>
                    
                </form>
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
