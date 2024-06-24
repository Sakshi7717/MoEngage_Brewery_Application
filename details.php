<?php

require_once "config.php";
$success = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['rname']);
    $breweryrating = trim($_POST['breweryrating']);
    $breweryid = trim($_POST['productid']);
    $rdescription = trim($_POST['rdescription']);

    if (empty($error) ) {
        $insertQuery = $db->prepare("INSERT INTO ratings (name, productid, ratings, description) VALUES (?, ?, ?, ?);");
        $insertQuery->bind_param("ssis", $fullname, $breweryid, $breweryrating, $rdescription);
        $result = $insertQuery->execute();
        if ($result) {
            $success .= '<p class="success">Ratings submitted!</p>';
        } else {
            $error .= '<p class="error">Something went wrong!</p>';
        }
    }
    echo "$error";
    $insertQuery->close();
    // Close DB connection
    //mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Custom Brewery - Using Open Brewery Api</title>
        <!-- Bootstrap icons-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Custom Brewery</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <?php session_start(); if (!isset($_SESSION["userid"])) { ?>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <?php } ?>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                        <?php if (isset($_SESSION["userid"]) && $_SESSION["user"] == true) { ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php }else{ ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-2">
            <div class="container px-4 px-lg-5 my-4">
                <div class="text-center text-white pb-3">
                    <h1 class="display-4 fw-bolder">Custom Brewery</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-4">
            <div class="container px-4 px-lg-5 mt-4">
                <div class="row brewery-info justify-content-center" id="brewerysinglewrap">
                    <div class="col-md-6 mb-5" >
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="text-left">
                                    <h5 class="fw-bolder">Product</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="text-left">
                                    <h5 class="fw-bolder">Submit Review</h5>
                                    <form action="" method="post">
                                        <div class="form-group pb-3">
                                            <label>Full Name</label>
                                            <input type="text" name="rname" class="form-control" required>
                                        </div>    
                                        <div class="form-group pb-3">
                                        <label>Ratings</label>
                                        <select class="form-select" id="breweryrating" name="breweryrating" required>
                                            <option value="">Choose type...</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Description</label>
                                            <input type="text" name="rdescription" class="form-control">
                                        </div> 
                                        <div class="form-group pb-4">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6>Brewery ratings</h6>
                                <?php 
                                //echo $_GET['id'];
                                $breid = $_GET['id'];
                                $ratingsql = "SELECT * FROM ratings WHERE productid = '$breid'";
                                $ratingresults = mysqli_query($db, $ratingsql);
                                //$ratingresults->num_rows;
                                if($ratingresults->num_rows > 0) {
                                    $row = mysqli_fetch_assoc($ratingresults);
                                    ?>
                                    <ul style="list-style-type: none; padding: 10px 0px;">
                                    <?php if ($row) {
                                    foreach ($ratingresults as $rating):?>
                                        <li class="ratings-list">
                                            <div>Name: <?php echo $rating['name'];?></div>
                                            <div>Rating: <?php echo $rating['ratings'];?></div>
                                            <div>Description: <?php echo $rating['description'];?></div>
                                        </li>
                                    <?php endforeach; 
                                    } ?>
                                    </ul>
                                <?php } else { ?>
                                    <div>No ratings found</div>
                                    <?php $error .= '<p class="error">No rows found</p>';
                                }
                                mysqli_close($db);
                                ?>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Custom Brewery 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script>
        //when the html page loads to the DOM
        window.addEventListener('load', (event) => {
            const resultwrap = document.getElementById('brewerysinglewrap');
            var html = "";
            singlebrewery();
            var html = "";
        });

        const singlebrewery = () => {
            const searchParams = new URLSearchParams(window.location.search);
            var singlebreweryid = searchParams.get('id');
            //console.log(searchParams.get('id')); 

            const url = `https://api.openbrewerydb.org/v1/breweries/${singlebreweryid}`;
            //console.log(url);

            fetch(url)
            //then grab the response and convert to JSON
            .then(function(data){
                return data.json();
            })
            //then render the beer data
            .then(rendersinglebrewery)
            .catch(function(e){
                console.log("Error: " + e);
            });
            html = "";
        
        }

        //implement renderBeer
        const rendersinglebrewery = breweryArray => {
        html = "";
        if(breweryArray){
                html += `<div class="col-md-6 mb-5"><div class="brewery-info card h-100">
                        <div class="card-body p-4">
                            <div class="text-left">
                                <h6 class="fw-bolder">${breweryArray['name']}</h6>
                                <p><span>Address:</span><br/>${breweryArray['address_1']}</p>
                                <p>Phone: ${breweryArray['phone']}</p>
                                <p>Website: ${breweryArray['website_url']}</p>
                                <p>${breweryArray['state']}, ${breweryArray['city']} </p>
                            </div>
                        </div>
                    </div></div> <div class="col-md-6 mb-5">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="text-left">
                                    <h5 class="fw-bolder">Submit Review</h5>
                                    <form action="" method="post">
                                        <div class="form-group pb-3">
                                            <input type="hidden" name="productid" value="${breweryArray['id']}"/>
                                            <label>Name</label>
                                            <input type="text" name="rname" class="form-control" required>
                                        </div>    
                                        <div class="form-group pb-3">
                                        <label>Ratings</label>
                                        <select class="form-select" id="breweryrating" name="breweryrating" required>
                                            <option value="">Choose type...</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        </div>
                                        <div class="form-group pb-3">
                                            <label>Description</label>
                                            <input type="text" name="rdescription" class="form-control">
                                        </div> 
                                        <div class="form-group pb-4">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>`
                
                const resultwrap = document.getElementById('brewerysinglewrap');
                resultwrap.innerHTML= html;
        }else{
            html += `<div class="col-md-12"><p>No results found!</p></div>`;
            resultwrap.innerHTML= html;
        }
        }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="./index.js"></script>
    </body>
</html>
