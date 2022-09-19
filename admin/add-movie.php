<?php
include_once "../Session.php";
include_once "../Validator.php";

  Session::start();
  if(!Session::exists('active_user'))  header("location: ../login.php");
if(($_SERVER['REQUEST_METHOD'] == 'POST')){
    include_once "../MoviesController.php";


    $moviesController = new MoviesController();
    $moviesController->addMovie();
    // var_dump($moviesController);
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="apple-touch-icon" sizes="120x120" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="../css/chosen.min.css" rel="stylesheet" type="text/css">


    <!-- Include English language -->
    <script src="js/plugins/datepicker/dist/js/i18n/datepicker.en.js"></script>

    <style>
        .page-link {
            background-color: unset !important;
            padding: 6px 12px 6px 12px !important;
            color:white;
            border: none;
        }
        .page-item {
            padding-bottom:4px;
        }
    </style>


</head>
<body>
<div class="container-fluid">
    <div class="row">
     <div class ="col-sm-12" style="padding-left:0px;padding-right:0px;">
        <div id="main-container">
                <aside id="left-sidebar">
                    <div id="nav-brand-container">
                        <div class = "sidebar-row">
                            <a id="nav-brand"> GoodMovies
                            </a>
                            <i id="bars" class="fas fa-bars"></i>
                        </div>
                    </div>
                        <div id="profile-pic-container">
                            <div class = "sidebar-row">
                                <img src="../images/admin.jpg" height="60px" width="60px">
                                <ul id="button-container">
                                    <li><strong><i>Welcome!</i> John Doe</strong><span class="active"></span></li>
                                    <li style="color:#4f5967; font-size:10px;font-weight: 800">ADMINISTRATOR</li>
                                    <li>
                                        <button class = "btn btn-edit-profile">Edit Profile</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <div class = "sidebar-row">
                        <div id="sidebar-items">
                            <ul>
                                <li>
                                    <a href="admin.php">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  href="admin.php">
                                        <i class="fas fa-file-video"></i>
                                        <span>Movies</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>

                                </li>
                                <li>
                                    <a>
                                        <i class="fas fa-tv"></i>
                                        <span>Genres</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <i class="far fa-images"></i>
                                        <span>Movie Icons</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                <span style="color:#2d3e50">EXTRAS</span>
                                    <li>
                                        <a>
                                            <i class="fas fa-tachometer-alt"></i>
                                            <span>Dashboard</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fas fa-users"></i>
                                            <span>Users</span>
                                        </a>
                                    </li>
                                <li>
                                    <a>
                                        <i class="fas fa-users-cog"></i>
                                        <span>User Config</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <i class="fas fa-money-check-alt"></i>
                                        <span>Payment Methods</span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Invoices</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            <div id="main-panel">
                <div id="notifications-container">
                        <h3>Movies</h3>
                        <ul style="display: flex;margin-left:auto">
                            <li>
                                <a class="nav-link">
                                    <i class="fas fa-address-card"></i>
                                </a>

                            </li>
                            <li>
                                <a class="nav-link">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link">
                                    <i class="fas fa-bell"></i>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link">
                                    <img src="../images/admin.jpg" height="25px" width="25px">
                                </a>

                            </li>
                            <li>
                                <a class="nav-link">
                                    John Doe
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </li>
                        </ul>
                </div>
                <div class="row">
        <div class="col-sm-12">
            <div id="add-movie-header">
                <h4>Add Movie</h4>
            </div>
            <div id="add-movie-form-container">
                <form class="form-horizontal" method="post" id="add-movie-form" action='add-movie.php' autocomplete="off" enctype="multipart/form-data" />

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="" name="mv_title" value="">
                                        <span class="help-block error">
                                        <?=  Validator::getErrorForField('mv_title') ?>
                                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Genre:</label>
                        <div class="col-sm-10">
                            <select data-placeholder="Select Genre(s)..." multiple class="form-control genre"  name="genres[]" id="genre[]">
                                 <?php
                                 include_once "../Crud.php";

                                 $crud = new Crud();

                                 $genres = $crud->read('Select * from genres');


                                 foreach($genres as $key => $genre){
                                 
                                 
                                 ?>   
                            <option value="<?=$genre['gnr_id'] ?>"><?=$genre['gnr_name']   ?></option>

                            <?php } ?>
                                   
                            </select>
                            <span class="help-block error">
                            <?=  Validator::getErrorForField('genres') ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="year">Year Released:</label>
                        <div class="col-sm-10">
                            <input id="datepicker" name="mv_year_released" data-date-format="yyyy-mm-dd" class="form-control" type="text" value="">
                                        <span class="help-block error">
                                        <?=  Validator::getErrorForField('mv_year_released') ?>
                                        </span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="year">Cover Image:</label>
                        <div class="col-sm-10">
                            <input type="file" name="cover_image" class="form-control" id="customFile" value="">
                                        <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn pull-right">Submit</button>
                            <a href="list-movies.php" class="btn pull-right" style="margin-right: 5px;">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/"> goodmovies</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    </div>

        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src = "../js/datepicker.min.js"></script>
<script src = "../js/datepicker.en.js"></script>
<script src = "../js/chosen.jquery.js"></script>


<script>
  $('#datepicker').datepicker({
    language: 'en',
  })

   $('.genre').chosen('Select Genre(s)');

</script>
</body>
</html>