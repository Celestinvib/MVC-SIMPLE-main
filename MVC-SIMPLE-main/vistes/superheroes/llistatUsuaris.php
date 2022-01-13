
<div class="container">
<?php
        echo "<a href='index.php?control=ControlUsuaris&operacio=showformnewUsuaris'>Nou</a>";
?>
 <table class="table table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Codi</th>      
      <th scope="col">Nom</th>
      <th scope="col">Cognoms</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col" colspan="3">Operacions</th>
             
    </tr>
  </thead>
  <tbody>

<?php
        
	
    	foreach($res as $user) {
		echo "<tr>";
    echo "<td>".$user['id']."</td>";
		echo "<td>".$user['nom']."</td>";
		echo "<td>".$user['cognoms']."</td>";
		echo "<td>".$user['email']."</td>";
		echo "<td>".$user['username']."</td>";
		echo "<td>".$user['password']."</td>";
    
		
		echo "<td><a href='index.php?control=ControlUsuaris&operacio=delete&codi=".$user['id']."'>
                     Esborrar</td>";
		echo "<td><a href='index.php?control=ControlUsuaris&operacio=showformupdate&codi=".$user['id']."'>
                     Actualitzar</td>";
                
		echo "</tr>";
        }
        echo "</table>";

        if(isset($_SESSION['missatge'])) {
			echo $_SESSION['missatge'];
			unset($_SESSION['missatge']);
		}
		
		
?>
<nav >
  <ul class="pagination">
    <?php
          for ($i=1; $i<=$total_pags; $i++) {
          echo "<li class='page-item'><a class='page-link' href='index.php?control=ControlUsuaris&page=".$i."' >".$i."</a></li>";
      }
    ?>
  </ul>
</nav>
</div>