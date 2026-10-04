<?php
include 'db.php';
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $pname = $_POST["pname"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = $conn -> prepare("insert into products(p_name,category,price,quantity) values (?,?,?,?);");
    $sql -> bind_param("ssii",$pname,$category,$price,$quantity);
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
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                    <a class="navbar-brand" href="#">Hello <?= $_SESSION["name"]; ?></a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="home.php" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                        </ul>
                        <form class="d-flex my-2 my-lg-0" action="pdf.php">
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Generate PDF

                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>
            <div
                class="container col-6 my-3 p-3 border rounded shadow"
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
                        />
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Product
                    </button>
                    
                </form>
            </div>
            
            <?php
             $result = $conn -> query("select p_name,category,price,quantity from products;"); ?>
            <div
                class="container col-10 border rounded shadow"
            >
                <table border="1" cellpadding="10">
                    <tr>
                        <td> Product Name </td>
                        <td> Product Category </td>
                        <td> Product Price </td>
                        <td> Product Quantity </td>
                        <td> Actions </td>
                    </tr>

                <?php while($row = $result -> fetch_assoc()){ ?>
                    <tr>
                        <td><?= $row["p_name"]; ?></td>
                        <td><?= $row["category"]; ?></td>
                        <td><?= $row["price"]; ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><a
                            name=""
                            id=""
                            class="btn btn-primary"
                            href="update.php?p_name=<?php echo $row["p_name"]; ?>"
                            role="button"
                            >Edit</a>
                            <a
                            name=""
                            id=""
                            class="btn btn-primary"
                            href="delete.php?p_name=<?php echo $row["p_name"]; ?>"
                            role="button"
                            >Delete</a>
                        </td>
                    </tr>

                <?php } ?>
                </table>
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
