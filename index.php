<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="http://localhost/site.webmanifest">
    <link rel="mask-icon" href="http://localhost/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Latest Movies</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/components/carousel/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js.download"></script>
</head>
<body style="background-color: #26262d">

<header>
<nav class="navbar navbar-expand-lg fixed-top" style="color:#f0f0f0 !important;">
    <a class="navbar-brand" href="http://localhost/movies_/">GoodMovies</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="color:#f0f0f0">
        MENU
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="http://localhost/movies_/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/movies_/#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="http://localhost/movies_/#">Contact us</a>
            </li>
        </ul>
        <section class="yOpR1 wG6fJ" style="width:34%;color:#ffffff;">
            <form action="" method="GET">
                <input class="" type="text" id="search-movies" placeholder="Find movies" name="search-item" required="" value="" style="width:100%">
            </form></section>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active btn-signup">
            <a class="nav-link" href="http://localhost/movies_/#" style="color:black !important;">Sign Up <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item btn-signin">
                <a class="nav-link" href="http://localhost/movies_/#">Sign In</a>
            </li>
        </ul>

    </div>
</nav>
</header>

<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 374px; overflow: hidden;background-size:cover">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item">
            <img class="first-slide" src="images/slide_1.jpg" alt="First slide" width="1780" height="370">
            <div class="">
                <div class="carousel-caption text-left">
                    <h1>The God Father.</h1>
                    <p>The Godfather is a 1972 American crime film directed by Francis Ford Coppola and produced by Albert S. Ruddy, based on Mario Puzo's best-selling novel of the same name..</p>
                    <p><a class="btn btn-lg btn-primary" href="http://localhost/movies_/#" role="button">Watch Now</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item active">
            <img class="third-slide" src="images/slide_2.jpg" alt="Third slide" width="1780" height="370">
            <div class="">
                <div class="carousel-caption text-right">
                    <h1>Pulp Fiction.</h1>
                    <p>Pulp Fiction is a 1994 American crime film written and directed by Quentin Tarantino; it is based on a story by Tarantino and Roger Avary.[4] Starring John Travolta, Samuel L. Jackson, Bruce Willis, Tim Roth</p>
                    <p><a class="btn btn-lg btn-primary" href="http://localhost/movies_/#" role="button">Watch Now</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="http://localhost/movies_/#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="http://localhost/movies_/#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<main role="main">

    <div class="container marketing">
        <h3 class="mv-category-title">Most Popular</h3>
        <div class="row" style="min-height: 300px;">     
            <?php
                include_once "MoviesController.php";
                $movies_controller = new MoviesController();

                if(isset($_GET['search-item'])){

                    $movies = $movies_controller->searchMovies(12,$_GET['search-item']);

                }else{

                    $movies = $movies_controller->getMovies(12);
                    
                }
               

                $pagination_links = $movies_controller->pagination_links;


            ?>
            <?php foreach($movies as $key => $movie) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                    <div class="card">
                        <img class="card-img-top" src="<?= $movie['img_path'] ?>">
                        <div class="card-block">
                            <h4 class="card-title"><?= $movie['mv_title'] ?></h4>
                        </div>
                        <div class="card-footer">
                            <div id="mv-details-container">
                                <div><?= $movie['genres'] ?></div>
                                <div><?= $movie['mv_year_released'] ?></div>
                            </div>
                            <div class="pl-right pg">
                                <div class="mv-pg">
                                    PG 14
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-sm-12" style="text-align:center;margin-top:10px">
                <nav aria-label="" class="pagination-centered" style="display: inline-block; background-color:inherit">
                    <ul class="pagination home-pagination">
                        <?= $pagination_links ?>
                     </ul>
                </nav>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->


    
</main>
<!-- FOOTER -->
<footer class="container-fluid">
        <p class="float-right"><a href="http://localhost/movies_/#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="http://localhost/movies_/#">Privacy</a> · <a href="http://localhost/movies_/#">Terms</a></p>
    </footer>

</body></html>