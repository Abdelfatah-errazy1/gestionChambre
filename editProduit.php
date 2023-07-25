<?php
require './config.php';
$id = $_GET['id'];
$ql = "SELECT * FROM achat WHERE id=:id ";
$statement = $bdd->prepare($ql);

$statement->execute([":id" => $id]);
$OPr = $statement->fetch(PDO::FETCH_OBJ);

//-----------------------------------------------------------------
$message = '';
if (isset($_POST['produit']) && isset($_POST['prix']) && isset($_POST['memberchamber'])) {
    if (!empty($_POST['produit']) && !empty($_POST['prix']) && !empty($_POST['memberchamber'])) {
        $produit = $_POST['produit'];
        $prix = $_POST['prix'];
        $memberchamber = $_POST['memberchamber'];

        //-----------------------------------------------------------------

        // M2   UPDATE

        $ql = "UPDATE produit SET produit=:produit, prix=:prix, memberchamber=:memberchamber WHERE  id=:id";
        $statement = $bdd->prepare($ql);

        if ($statement->execute([":produit" => $produit, ":prix" => $prix, ":memberchamber" => $memberchamber, ":id" => $id])) {
              header("Location:/gestionchamber/editProduit.php");
        }
    }
}
$s=$bdd->prepare("SELECT * from memberchamber");
$s->execute();
$data=$s->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        Formulaire html
    </title>
</head>

<body>
    <?php if (!empty($message)) : ?>
        <div>
            <?= $message; ?>
        </div>
    <?php endif; ?>


    <div class="login-form">


<form action="index.php" method="post">
	<div class="mt-3 row">
    <label class="col-sm-2 col-form-label bold">titre produit</label>
    <div class="col-sm-10">
      <input type="text" name="produit" required class="form-control" value="<?= $OPr->produit; ?>" >
			
    </div>
  </div>
	<div class="mt-3 row">
    <label class="col-sm-2 col-form-label bold">prix produit</label>
    <div class="col-sm-10">
      <input type="number" name="prix" required class="form-control" value="<?= $OPr->prix; ?>">
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
	<button type="submit" class="btn btn-primary" >ajouter</button>
</form>
</div>

</body>

</html>
