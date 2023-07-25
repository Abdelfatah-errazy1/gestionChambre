<?php
  require './config.php';
	$s=$bdd->prepare("SELECT * from memberchamber,achat where achat.memberchamber=memberchamber.id");
  $s->execute();
  $data=$s->fetchAll(PDO::FETCH_OBJ);

?>


<!doctype html >
<html>
<head><title>listes des produits </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./style.css">
</head>
<body>
<?php require './navbar.php'; ?>
<table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nom</th>
      <th scope="col">produit</th>
      <th scope="col">prix</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
<?php 
foreach($data as $produit){
  ?>
  <tr>
    <td><?php echo $produit->id ;?></td>
    <td><?php echo $produit->nomComplete ;?></td>
    <td><?php echo $produit->produit ;?></td>
    <td><?php echo $produit->prix ;?></td>
    <td>
      <a class="btn btn-success" href="editProduit.php?id=<?= $produit->id ?>">Modifier </a>
      <a class="btn btn-danger" href="SupprimerProduit.php?id=<?= $produit->id?>" 
      onclick="return confirm('Voulez vous vraiment supprimer ?')" >supprimer </a>
    </td>
</tr>

  
  <?php
}

?>

</tbody>

</table>

<div class="d-flex justify-content-center">
<a class="btn btn-danger p-2" href="./reset.php" 
      onclick="return confirm('Voulez vous vraiment supprimer tout ?')" >supprimer tout
     </a>

</div>
</body>
</html>















