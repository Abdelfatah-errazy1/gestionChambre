<?php

	require './config.php';
	if(!empty($_POST['produit']) && !empty($_POST['prix'])){
		$produit = $_POST['produit'];
		$prix = $_POST['prix'];
		$memberchamber = $_POST['memberchamber'];
		$check=$bdd->prepare("insert into achat(produit,prix,memberChamber) values(?,?,?) ");
		$check->execute([$produit,$prix,$memberchamber]);

		$s=$bdd->prepare("select * from achat ORDER BY id DESC LIMIT 1");
		$s->execute();
		$achat=$s->fetch(PDO::FETCH_OBJ);

		$prixMember= $prix/count($_POST['iamhere']);
		if(isset($_POST['iamhere']))
		{
			foreach($_POST['iamhere'] as $valeur)
			{
				$check=$bdd->prepare("insert into memberAchat(memberchamber,achat) values(?,?) ");
				$check->execute([$valeur,$achat->id]);		
			}
			foreach($_POST['iamhere'] as $valeur)
			{
				if($valeur===$memberchamber){
					$prixAchatM = $prix - $prixMember;
					$check=$bdd->prepare("update whatihave set money=money+? where memberchamber=? ");
					$check->execute([$prixAchatM,$memberchamber]);

				}else{		
					$check=$bdd->prepare("update whatihave set money=money-? where memberchamber=? ");
					$check->execute([$prixMember,$valeur]);
				}				
			}
		}
	}
	$s=$bdd->prepare("SELECT * from memberchamber");
	$s->execute();
	$data=$s->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html >
<html>
<head><title>ajouter produit</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./style.css">
</head>
<body>
<?php require './navbar.php'; ?>
<div class="login-form">


<form action="index.php" method="post">
	<div class="mt-3 row">
    <label class="col-sm-2 col-form-label bold">titre produit</label>
    <div class="col-sm-10">
      <input type="text" name="produit" required class="form-control" autocomplete="off" >
			<datalist id="datalistOptions">
				<option value="San Francisco">
				<option value="New York">
				<option value="Seattle">
				<option value="Los Angeles">
				<option value="Chicago">
			</datalist>
    </div>
  </div>
	<div class="mt-3 row">
    <label class="col-sm-2 col-form-label bold">prix produit</label>
    <div class="col-sm-10">
      <input type="number" name="prix" required class="form-control">
    </div>
  </div>
	<div class="mt-3 row">
    <label class="col-sm-2 col-form-label bold">memberChamber</label>
    <div class="col-sm-10">
		<select name="memberchamber" class="form-select"  id="">
			<?php
				if(!empty($data)){
					foreach ($data as $member) {
			?>
			<option value="<?php echo $member->id; ?>"><?php echo $member->nomComplete; ?></option>
			<?php
					}
				}
			?>
		</select>
    </div>
  </div>
	
	<div class="d-flex mt-4">
		<?php
			if(!empty($data)){
				foreach ($data as $member) {
		?>
		<div class="form-check m-2">
			<input class="form-check-input" type="checkbox" name="iamhere[]" 
				value="<?php echo $member->id; ?>"  id="flexCheckChecked" checked>
			<label class="form-check-label" for="flexCheckChecked">
				<?php echo $member->nomComplete; ?>
			</label>
		</div>
		<?php
				}
			}
		?>
	</div>
	<button type="submit" class="btn btn-success" >Modifier</button>
</form>
</div>

</body>
</html>
