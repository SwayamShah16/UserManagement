<?php 
include 'db.php';
session_start();

if(isset($_GET["pname"])){
    $pname = $_GET["pname"];

    $sql = $conn -> prepare("select * from products where pname = ?");
    $sql -> bind_param("s",$pname);
    $sql -> execute();

    $output = $sql -> get_result();
    $result = $output -> fetch_assoc();

}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = $conn -> prepare("update products set category=?,price=?,quantity=? where pname =?;");
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
                class="container col-7 my-3 p-3 border rounded shadow"
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
                            value = <?= $result["pname"] ?>
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
                            value = <?= $result["category"] ?>
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input
                            type="text"
                            class="form-control"
                            name="price"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value = <?= $result["price"] ?>
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input
                            type="text"
                            class="form-control"
                            name="quantity"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value = <?= $result["quantity"] ?>
                        />
                    </div>
                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        Update Product
                    </button>
                    
                </form>
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
