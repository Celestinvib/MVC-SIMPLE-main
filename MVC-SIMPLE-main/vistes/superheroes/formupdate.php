<?php
include_once 'helpers/request.php';
?>

<div class="container">
<h3>Editar Superheroi</h3>
<form method="POST" action="index.php?control=ControlSuperheroes&operacio=update&codi=<?php echo $codi ?>">
	<!-- poso $codi perquè en a ControlSUperheroes , he guardat el $_GET['codi'] (seria lo mateix) -->
  <div class="form-group">
      <label>Nom Superheroi</label>
      <input type="text" class="form-control" name="heroname" value="<?php mostraValor('heroname'); ?>">      
  </div>
  <div class="form-group">
      <label>Nom real</label>
      <input type="text" class="form-control" name="realname" value="<?php mostraValor('realname'); ?>">      
  </div>	
 	
  <div class="form-group">
      <label>Gènere</label>
      <input type="text" class="form-control" name="gender" value="<?php mostraValor('gender'); ?>">      
  </div>

  <div class="form-group">
      <label>Procedència</label>
      <input type="text" class="form-control" name="race" value="<?php mostraValor('race'); ?>">     
  </div>
<div class="form-group">
  <button type="submit" class="btn btn-primary">Actualitzar</button>
</div>
  	

   
</form>
<?php
 if(isset($_SESSION['missatge'])) {
      echo $_SESSION['missatge'];
      unset($_SESSION['missatge']);
    }
?>

</div>