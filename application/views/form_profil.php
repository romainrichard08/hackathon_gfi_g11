<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<aside state='{{preview}}'>
	<ul class='onglets'>
		<li class='onglet'
		ng-repeat='onglet in onglets'
		state='{{etape == onglet.etape?"true":"false"}}'
		ng-click='changeView(onglet, $event)'
		ng-cloak>
			<img ng-hide='preview && etape == onglet.etape' src="<?php echo base_url(); ?>assets/img/{{onglet.img}}{{etape == onglet.etape?'-orange':''}}.png" alt="">
			<img ng-show="preview && etape == onglet.etape" src="<?php echo base_url(); ?>assets/img/arrow-back-orange.png" alt="">
		</li>
	</ul>

</aside>

<div class="sectionContain">
	<section ng-show='etape == 1'>
		<div class="title">
			<div class="wrap">
				<div class="etape">
					Etape <br>
					{{etape}} sur 5
				</div>
				<div class="text">
					Bienvenue sur l'espace Carrières de GFI
				</div>
			</div>
		</div>
		<div class="corps">
			<form id='searchJob' method="post">
					<div class="form-wrap">
						<div class="form-content">
							<label>Dans quelle branche souhaitez-vous nous rejoindre?</label>
							<select id="branche" required>
							  <option value="Commercial">Commercial</option>
							  <option value="Informatique" selected>Informatique</option>
							  <option value="Ressources-humaines">Ressources Humaines</option>
							</select>
						</div><!--
  			--><div class="form-content">
							<label>Quel type de contrat recherchez-vous?</label>
							<select id="contrat" required>
							  <option value="CDI">CDI</option>
							  <option value="CDD">CDD</option>
							  <option value="Stage">Stage</option>
							  <option value="Alternance">Alternance</option>
							</select>
						</div><!--
  			--><div class="form-content">
							<label>Ou êtes-vous ?</label>
					    <select id="localisation" required>
					      <option value="Paris">(75) - Paris</option>
					      <option value="Marseille">(13) - Marseille</option>
					      <option value="Lyon">(69) - Lyon</option>
					    </select><br>
						</div>
						<div class="form-content" full>
							<label>Quelles compétences avez-vous? (Entrée pour ajouter)</label>
							<div id='ajout-tag-wrap' class='f-left'>
					        <ul class='u-t-input f-left w-100 h-auto'>

					            <input class='inputTagsText f-left' type='text' placeholder='Compétence...'>
					        </ul>
					        <ul class='searchResult'>

					        </ul>
					    </div>
					    <input id='uploadTagsValues' type='text' name='tags' style='display:none;'>
						</div>
					</div>



					<div class="footer">
						<button type="submit" class='bouton' design='orange' value="Rechercher">Rechercher des offres</button>
					</div>
			</form>
		</div>
	</section>
	<section id='offers' ng-if='etape == 2' state='{{preview}}'>
		<div class="title">
			<div class="wrap">
				<div class="etape">
					Etape <br>
					{{etape}} sur 5
				</div>
				<div class="text">
					Offres que nous avons trouvé pour vous
				</div>
			</div>
		</div>
		<div class="corps">
			<div class="windowLoad">
				<div class="image">
					<img src="<?php echo base_url(); ?>/assets/img/load.svg" alt="">
				</div>
				<div class="infos">
					<p>Veuillez patienter, nous recherchons des offres adaptées à vos compétences</p>
				</div>
			</div>
			<div ng-if='showJobs && jobs.length == 0' class="noOffer">
				Nous n'avons trouvé aucune offres correspondant à vos critères
			</div>
			<div class="offer-wrap" idoffer='{{offer.id}}'
					 ng-repeat='offer in jobs track by offer.id | orderBy: "-label.length"'
					 ng-click='openOffer(offer, $event, $index)'>
				<div class="offer">
					<div class="libelle">
						{{offer.libelle}}
					</div>
					<div class="duree">
						Expérience minimum: {{offer.experience_min}}
					</div>
					<div class="localisation">
						Localisation: {{offer.departement}}
					</div>
					<div class="competences">
						<div class='tag' ng-repeat='comp in offer.label'>
							{{comp}}
						</div>
					</div>
					<div class="footer">
						CONSULTER L'OFFRE >
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="offer-window" state='{{preview}}'>
		<div class="title">
			<div class="wrap">
				<div class="etape">
					Offre <br>
					{{dataOffer.index + 1}} sur {{jobs.length}}
				</div>
				<div class="text">
					{{dataOffer.libelle}}
				</div>
			</div>
		</div>
		<div class="corps">
			<div class="infos_wrapper">
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
				<button id="postuler" dataOffer='{{dataOffer.id}}' class='bouton' design='blanc' ng-click='inscription(dataOffer, $event)'>POSTULER A CE POSTE</button>
			</div>
		</div>

	</section>

	<section id='inscription' ng-if='etape == 3'>
    <div class="title">
      <div class="wrap">
        <div class="etape">
          Etape <br>
          {{etape}} sur 5
        </div>
        <div class="text">
          Création du profil candidat
        </div>
      </div>
    </div>
    <div class="corps">
		  <form id='inscription' method="post" enctype="multipart/form-data">
		      <div class="form-wrap">
		        <div class="form-content">
		          <label>Nom:</label>
		          <input type="text" id="nom" />
		        </div><!--
		    --><div class="form-content">
		          <label>Prénom:</label>
		          <input type="text" id="prenom" />
		        </div>
		        <div class="form-content">
		          <label>CV:</label>
		          <input type="file" id="cv" />
		        </div>
		        <div class="form-content">
		          <label>E-mail:</label>
		          <input type="text" id="email" />
		        </div>
		      <div class="footer">
		        <button type="submit" class='bouton' design='orange' value="sinscrire">S'inscrire</button>
		      </div>
		    </div>
		  </form>
    </div>
  </section>




</div>
