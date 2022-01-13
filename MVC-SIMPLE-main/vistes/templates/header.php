<!doctype html>
<html lang="en">
  <head>
    <title>MVC!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    
  </head>
  
  <body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>    
      </ul>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MVC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

       <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?control=ControlProva1">Prova_1_1</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?control=ControlProva1&operacio=salutacions">Prova_1_2</a>
        </li> -->

        
      <?php if (isset($_SESSION['username'])) { ?>

      <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?control=ControlProva2">Prova_2_1</a>
        </li> -->

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?control=ControlUsuaris">Usuaris</a>
        </li>

      <li class="nav-item">
        <a class="nav-link" href="index.php?control=ControlSuperheroes">Superherois</a>
      </li>
      
      
           <li class="nav-item">
              <a class="nav-link" href="index.php?control=ControlLogin&operacio=logout">Logout</a>
           </li>
      <?php } 
      else { ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?control=ControlLogin">Login</a>
      </li>
      <?php } ?>
      
      
    </ul>
    
  </div>
</nav>


