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
			    <input id='uploadTagsValues' value='1/' type='text' name='tags' style='display:none;'>
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
			<div class="offer" idoffer='{{offer.id}}' ng-repeat='offer in jobs track by offer.id'>
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
	<section id="offer" style="display:none;">
  <div>

  <div>
    <p>Libellé: {{dataOffer.libelle}}</p>
  </div>

  <div>
    <p>Description: {{dataOffer.description}}</p>
  </div>

  <div>
    <p>Metier: {{dataOffer.metier}}</p>
  </div>

  <div>
    <p>Contrat: {{dataOffer.contrat}}</p>
  </div>

  <div>
    <p>Departement: {{dataOffer.departement}}</p>
  </div>

  <div>
    <p>Profil: {{dataOffer.profil}}/p>
  </div>

  <div>
    <p>Entite: {{dataOffer.entite}}</p>
  </div>

  <div>
    <p>Expérience mini: {{dataOffer.experience_min}}</p>
  </div>

  <div>
    <button type="button">POSTULER !</button>
  </div>

</div></section>
</div>
