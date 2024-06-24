<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Custom Brewery - Using Open Brewery Api</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
                <div class="search-container">
                    <form class="breweryform row g-3" method="post" onsubmit="return false;">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="fbreweryname" id="fbreweryname" placeholder="Search by name">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="fbrewerycity" id="fbrewerycity" placeholder="Search by city">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="fbrewerytype" name="fbrewerytype" required>
                                <option value="">Choose type...</option>
                                <option value="micro">micro</option>
                                <option value="nano">nano</option>
                                <option value="regional">regional</option>
                                <option value="brewpub">brewpub</option>
                                <option value="large">large</option>
                                <option value="bar">bar</option>
                              </select>
                        </div>
                        <div class="col-md-2">
                          <button type="submit" id="btnsearch" class="btn btn-primary mb-3" style="width:100%;">Submit</button>
                        </div>
                      </form>
                    
                    <!-- <form class="beer-search" onsubmit="return false;">
                      <input type="text" name="beername" id="beername" class="form-control">
                      <input type="submit" id="btnsearch" class="btn btn-primary">
                    </form> -->
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-4">
            <div class="container px-4 px-lg-5 mt-4">
                <div class="row brewery-info justify-content-center" id="brewery-wrap">
                    <p>Search to find near by breweries.</p>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Custom Brewery 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="./index.js"></script>
    </body>
</html>
