<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SideBar.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> <!--Utilisation d'un CDN du LineIcon-->
    <!--CDN via jsDelivr dans Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PHP Project</title>
    <!--Integration de sweetalert pour l'alert lors de la phase de delete-->
    <script src="sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">ByteWizard</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="Employe.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Employés</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Lieu.php" class="sidebar-link">
                        <i class="lni lni-map-marker"></i>
                        <span>Lieu</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Affectation.php" class="sidebar-link">
                        <i class="lni lni-move"></i>
                        <span>Gestion d'afféctation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Historique.php" class="sidebar-link">
                        <i class="lni lni-information"></i>
                        <span>Historique</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </aside>
        <div class="main-p3">
            
