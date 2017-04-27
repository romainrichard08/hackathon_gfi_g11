<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="sectionContain" ng-controller='jobs'>
	<section id='formulaire'>
		<div class="title">
			Bienvenue sur l'espace Carrières de GFI
		</div>
		<div class="corps">
			<form id='searchJob' method="post">
					<label class='label'>Dans quelle branche souhaitez-vous nous rejoindre?</label>
					<select id="branche" required>
					  <option value="Commercial">Commercial</option>
					  <option value="Informatique" selected>Informatique</option>
					  <option value="Ressources-humaines">Ressources Humaines</option>
					</select><br>

					<label class='label'>Quel type de contrat recherchez-vous?</label>
					<select id="contrat" required>
					  <option value="CDI">CDI</option>
					  <option value="CDD">CDD</option>
					  <option value="Stage">Stage</option>
					  <option value="Alternance">Stage</option>
					</select><br>

					<label class='label'>Ou êtes-vous ?</label>
			    <select id="localisation" required>
			      <option value="Paris">(75) - Paris</option>
			      <option value="Marseille">(13) - Marseille</option>
			      <option value="Lyon">(69) - Lyon</option>
			    </select><br>

					<label class='label'>Quelles compétences avez-vous? (Entrée pour ajouter)</label>
					<div id='ajout-tag-wrap' class='input-form f-left'>
			        <ul class='u-t-input f-left w-100 h-auto'>

			            <input class='inputTagsText f-left' type='text' placeholder='Compétence...'>
			        </ul>
			        <ul class='searchResult'>

			        </ul>
			    </div>
			    <input id='uploadTagsValues' type='text' name='tags' style='display:none;'>
					<br> <br>
					<div class="footer">
						<button type="submit" class='bouton' design='orange' value="Rechercher">Rechercher</button>
					</div>
			</form>
		</div>
	</section>
	<section ng-if='!showJobs'>
		<div class="windowLoad">
			<div class="image">
				<img src="<?php echo base_url(); ?>/assets/img/load.svg" alt="">
			</div>
			<div class="infos">
				<p>Veuillez patienter, nous recherchons des offres adaptées à vos compétences</p>
			</div>
		</div>
	</section>
	<section id='offers' ng-if='showJobs'>
		<div class="title">
			Offres que nous avons trouvé pour vous
		</div>
		<div class="corps">
			<div ng-if='jobs.length == 0' class="noOffer">
				Nous n'avons trouvé aucune offres correspondant à vos critères
			</div>
			<div class="offer" idoffer='{{offer.id}}' ng-repeat='offer in jobs track by offer.id | orderBy: "-label.length"' ng-click='openOffer(offer)'>
				<div class="libelle">
					{{offer.libelle}}
				</div>
				<div class="localisation">
					Localisation: {{offer.departement}}
				</div>
				<div class="competences">
					<div class='tag' ng-repeat='comp in offer.label'>
						{{comp}}
					</div>
				</div>
				<br>
			</div>
		</div>
	</section>

	<div id="popup">
		<div class="title">
			{{dataOffer.libelle}}
		</div>
		<div class="corps">
			<div class="infos_offer">
				<strong>Description:</strong> {{dataOffer.description}} <br>
			</div>
			<div class="infos_offer">
				<strong>Metier:</strong> {{dataOffer.metier}} <br>
			</div>
			<div class="infos_offer">
				<strong>Contrat:</strong> {{dataOffer.contrat}} <br>
			</div>
			<div class="infos_offer">
				<strong>Localisation:</strong> {{dataOffer.departement}} <br>
			</div>
			<div class="infos_offer">
				<strong>Profil:</strong> {{dataOffer.profil}} <br>
			</div>
			<div class="infos_offer">
				<strong>Entité:</strong> {{dataOffer.entite}} <br>
			</div>
			<div class="infos_offer">
				<strong>Expérience minimale:</strong> {{dataOffer.experience_min}} ans <br>
			</div>
		</div>
		<div class="footer">
			<a href='<?php echo base_url(); ?>Home/testTechnique?idOffer={{dataOffer.id}}' class='bouton' design='blanc' name="button">Postuler</a>

		</div>

	</div>


</div>
