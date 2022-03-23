<?php include 'function.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="style.css">
    <title>Gestion Des Stagiaires</title>
</head>
<body>
<div class="container-fluid position-absolute">
    <div class="mt-5">
        <form action="tr.php" method="post" class="w-100 border border-secondary border-2 rounded-3 p-5">
            <?php
                if(isset($_GET['found'])){
                    echo "<div class='alert alert-danger'>";
                    echo "The Number Exists! Enter another Number";
                    echo "</div>";
                }
            ?>
            <h1 class="display-4 mb-4">Enter Your Information</h1>
            <div class="row">
                <div class="col"><input class="form-control m-3" type="text" name="name" placeholder="Your name"></div>
                <div class="col"><input class="form-control m-3" type="number" name="number" placeholder="Your number"></div>
            </div>
            <input class="form-control m-3" type="email" name="email" placeholder="Your email">
            <select name="listDivision" class="form-select m-3">
                <option value="TDI">TDI</option>
                <optgroup label="Méters du Commerce et de Gestion">
                    <optgroup label="Technicien Spécialisé">
                        <option>Commerce et Marketing</option>
                        <option>Finance et Comptabilité</option>
                        <option>Office Manager</option>
                        <option>Ressources Humaines</option>
                    </optgroup>
                    <optgroup label="Technicien">
                        <option>Commerce</option>
                        <option>comptabilité</option>
                        <option>Gestion</option>
                    </optgroup>
                </optgroup>
                <optgroup label="Méters duDigital & Intelligence Artificielle">
                    <optgroup label="Technicien Spécialisé">
                            <option>Cyber sécurité</option>
                            <option>Systèmes et Réseaux</option>
                            <option value="Développement Mobile">Développement Mobile</option>
                            <option value="Développement Digital">Développement Digital</option>
                    </optgroup>
                    <optgroup label="Technicien">
                        <option>Maintenance et Support Informatique et Réseaux</option>
                    </optgroup>
                </optgroup>
            </select>
            <button type="submit" class="btn btn-primary m-3 w-100 btn-outline-secondary text-light">submit</button>
        </form>
        <div class="mt-2">
            <div>
                <form action="tr.php" method="post" class="w-100 mb-2 border border-secondary border-2 rounded-3 p-4"  id="select">
                    <h3 class="display-5 mt-4">Delete</h3>
                    <div>
                        <input class="form-control m-3" type="number" name="delete-nb" placeholder="Your number">   
                        <button class="btn btn-primary m-3 mt-2 w-100 btn-outline-secondary text-light" type="submit">Delete</button>
                    </div>
                </form>
            </div>
            <div>
                <form action="index.php" method="post" id="search-form" class="w-100 mb-2 h-auto border border-secondary border-2 rounded-3 p-4">
                    <div id="select">
                        <h1 class="display-5 mt-4">Search</h1>
                        <div>
                            <input class="form-control m-3" type="number" name="search-nb" placeholder="Your number">
                            <button class="btn btn-primary m-3 mt-2 w-100 btn-outline-secondary text-light" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <form action="tr.php" method="post" class="w-100 mb-3 border border-secondary border-2 rounded-3 p-5">
                    <?php
                        if(isset($_GET['modify'])){
                            $modify = $_GET['modify'];
                            if($modify == 'true'){
                                alertExist();
                            }elseif($modify == 'false'){
                                alertNotExist();
                            }
                        }
                    ?>
                    <h1 class="display-5 mb-4">Modify Your Information</h1>
                    <div class="row">
                        <div class="col"><input class="form-control m-3" type="number" name="confirm-nb" placeholder="Your number"></div>
                        <div class="col"><input class="form-control m-3" type="text" name="new-name" placeholder="New name"></div>
                    </div>
                    <input class="form-control m-3" type="email" name="new-email" placeholder="New email">
                    <select name="new-division" class="form-select m-3">
                        <option value="TDI">TDI</option>
                        <optgroup label="Méters du Commerce et de Gestion">
                            <optgroup label="Technicien Spécialisé">
                                <option>Commerce et Marketing</option>
                                <option>Finance et Comptabilité</option>
                                <option>Office Manager</option>
                                <option>Ressources Humaines</option>
                            </optgroup>
                            <optgroup label="Technicien">
                                <option>Commerce</option>
                                <option>comptabilité</option>
                                <option>Gestion</option>
                            </optgroup>
                        </optgroup>
                        <optgroup label="Méters duDigital & Intelligence Artificielle">
                            <optgroup label="Technicien Spécialisé">
                                    <option>Cyber sécurité</option>
                                    <option>Systèmes et Réseaux</option>
                                    <option value="Développement Mobile">Développement Mobile</option>
                                    <option value="Développement Digital">Développement Digital</option>
                            </optgroup>
                            <optgroup label="Technicien">
                                <option>Maintenance et Support Informatique et Réseaux</option>
                            </optgroup>
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-primary m-3 w-100 btn-outline-secondary text-light">Modify</button>
                </form>
            </div>
        </div>
    </div>
    <section>
       <div>
            <form action="index.php" method="post" class="w-100 mt-5 p-4 mb-4 border border-secondary border-2 rounded-3" id="select">
                <h1 class="w-100 mt-3 display-5">Select by Division</h1>
                <div class="w-75">
                    <select name="lisT" class="form-select">
                        <option value="All">All</option>
                        <option value="TDI">TDI</option>
                        <optgroup label="Méters du Commerce et de Gestion">
                            <optgroup label="Technicien Spécialisé">
                                <option>Commerce et Marketing</option>
                                <option>Finance et Comptabilité</option>
                                <option>Office Manager</option>
                                <option>Ressources Humaines</option>
                            </optgroup>
                            <optgroup label="Technicien">
                                <option>Commerce</option>
                                <option>comptabilité</option>
                                <option>Gestion</option>
                            </optgroup>
                        </optgroup>
                        <optgroup label="Méters duDigital & Intelligence Artificielle">
                            <optgroup label="Technicien Spécialisé">
                                <option>Cyber sécurité</option>
                                <option>Systèmes et Réseaux</option>
                                <option value="Développement Mobile">Développement Mobile</option>
                                <option value="Développement Digital">Développement Digital</option>
                            </optgroup>
                            <optgroup label="Technicien">
                                <option>Maintenance et Support Informatique et Réseaux</option>
                            </optgroup>
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3 w-100 btn-outline-secondary text-light">Select</button>
                </div>
            </form>
       </div>
       <div>
           <?php
                echo "<table class='table table-primary table-striped text-center table-bordered'>";
                echo "<thead><tr><th>Number</th><th>Name</th><th>Email</th><th>Division</th></tr></thead>";
                if(!isset($_POST['lisT']) && !isset($_POST['search-nb'])){
                    CreateTable();
                }elseif(isset($_POST['lisT'])){
                    BySelector($_POST['lisT']);
                }elseif(isset($_POST['search-nb'])){
                    $search = $_POST['search-nb'];
                    Search($search);
                }
            ?>
       </div>
    </section>
</div>
</body>
</html>