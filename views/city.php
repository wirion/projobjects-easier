<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">Sélection</div>
	<div class="panel-body">
		<?php include 'alerts.php'; ?>
		<form action="" method="get">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php $selectCities->displayHTML(); ?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input type="submit" class="btn btn-success btn-block" value="Sélectionner" />
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<a href="?" class="btn btn-info btn-block">Ajouter</a>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading"><strong>CITY</strong> <?php if ($cityObject->getId() > 0) : ?>Modification<?php else : ?>Ajout<?php endif ?></div>
	<div class="panel-body">
		<form action="" method="post">
			<input type="hidden" name="id" value="<?= $cityObject->getId() ?>">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="cit_name">Nom</label>
						<input type="text" class="form-control" name="cit_name" id="cit_name" placeholder="Nom" value="<?= $cityObject->getName() ?>">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="cou_id">Pays</label>
						<?php $selectCountries->displayHTML(); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="submit" class="btn btn-success btn-block" value="Submit" />
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<a href="?delete=<?= $cityObject->getId() ?>" class="btn btn-warning btn-block<?php if ($cityObject->getId() <= 0) : ?> disabled<?php endif; ?>" role="button" aria-disabled="true">Supprimer</a>
				</div>
			</div>
		</form>
	</div>
</div>
