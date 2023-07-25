<?php
  require './config.php';
	$s=$bdd->prepare("SELECT * from memberchamber,whatihave where whatihave.memberchamber=memberchamber.id");
  $s->execute();
  $data=$s->fetchAll(PDO::FETCH_OBJ);

?>


<!doctype html >
<html>
<head><title>whatihave</title>
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
      <th scope="col">whatihave</th>
     
    </tr>
  </thead>
  <tbody>
<?php 
foreach($data as $whatihave){
  ?>
  <tr>
    <td><?php echo $whatihave->id ;?></td>
    <td><?php echo $whatihave->nomComplete ;?></td>
    <td><?php echo $whatihave->money ;?></td>
   
  </tr>
  
  <?php
}

?>

</tbody>

</table>
</body>
</html>















