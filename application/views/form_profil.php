<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<aside>
	<ul class='onglets'>
		<li class='onglet'
		ng-repeat='onglet in onglets'
		state='{{etape == onglet.etape?"true":"false"}}'
		ng-click='changeView(onglet, $event)'
		ng-cloak>
			<img ng-hide='previewGlobal && etape == onglet.etape' src="<?php echo base_url(); ?>assets/img/{{onglet.img}}{{etape == onglet.etape?'-orange':''}}.png" alt="">
			<img ng-show="previewGlobal && etape == onglet.etape" src="<?php echo base_url(); ?>assets/img/arrow-back-orange.png" alt="">
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
							<label class='label'>Dans quelle branche souhaitez-vous nous rejoindre?</label>
							<select id="branche" required>
							  <option value="Commercial">Commercial</option>
							  <option value="Informatique" selected>Informatique</option>
							  <option value="Ressources-humaines">Ressources Humaines</option>
							</select>
						</div><!--
  			--><div class="form-content">
							<label class='label'>Quel type de contrat recherchez-vous?</label>
							<select id="contrat" required>
							  <option value="CDI">CDI</option>
							  <option value="CDD">CDD</option>
							  <option value="Stage">Stage</option>
							  <option value="Alternance">Alternance</option>
							</select>
						</div><!--
  			--><div class="form-content">
							<label class='label'>Ou êtes-vous ?</label>
					    <select id="localisation" required>
					      <option value="Paris">(75) - Paris</option>
					      <option value="Marseille">(13) - Marseille</option>
					      <option value="Lyon">(69) - Lyon</option>
					    </select><br>
						</div>
						<div class="form-content" full>
							<label class='label'>Quelles compétences avez-vous? (Entrée pour ajouter)</label>
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
	<section id='offers' ng-if='etape == 2' state='{{preview1}}'>
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


	<section id="offer-window" slide state='{{preview1}}'>
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
				<div class="description">
					<div class='d-title'>
						Description
					</div>
					<div class="d-content">
						{{dataOffer.description}}
					</div>
				</div>
				<div class="i-infos">
					<div class="infos_offer">
						<strong>Metier:</strong> {{dataOffer.metier}} <br>
					</div>
					<div class="infos_offer">
						<strong>Contrat:</strong> {{dataOffer.contrat}} <br>
					</div>
					<div class="infos_offer">
						<strong>Ville:</strong> {{dataOffer.departement}} <br>
					</div>
					<div class="infos_offer">
						<strong>Profil:</strong> {{dataOffer.profil}} <br>
					</div>
					<div class="infos_offer">
						<strong>Expérience minimale:</strong> {{dataOffer.experience_min}} ans <br>
					</div>
				</div>
				<div class="description">
					<div class='d-title'>
						Entité
					</div>
					<div class="d-content">
						{{dataOffer.entite}}
					</div>
				</div>
			</div>
			<div class="footer">
				<button id="postuler" dataOffer='{{dataOffer.id}}' class='bouton' design='orange' ng-click='candidateInterface(dataOffer, $event)'>POSTULER A CE POSTE</button>
			</div>
		</div>
	</section>




  <section id="candidateInterface" ng-if='etape == 3' state='{{preview2 || preview3}}'>
    <div class="title">
      <div class="wrap">
        <div class="etape">
          Etape <br>
          {{etape}} sur 5
        </div>
        <div class="text">
          Espace de connexion
        </div>
      </div>
    </div>
    <div class="corps">
      <div class="choix">
        <div class="cand-connex">
          <div>Vous êtes déjà inscrit?</div>
          <button class='bouton' design='orange' id="connexion" dataOffer='{{dataOffer.id}}' ng-click='goToConnexion(dataOffer, $event)'>Connexion</button>
        </div>
        <div class="cand-connex">
          <div>Vous n'avez pas encore de compte candidat?</div>
          <button class='bouton' design='orange' id="inscription" ng-click='goToInscription(dataOffer, $event)' >Inscription</button>
        </div>
      </div>
    </div>
  </section>





<section id='connexion' slide state='{{preview2}}'>
    <div class="title">
      <div class="wrap">
        <div class="etape">
          Etape <br>
          {{etape}} sur 5
        </div>
        <div class="text">
          Connexion à votre compte candidat
        </div>
      </div>
    </div>
    <div class="corps">
      <form id='connexionForm' method="post" enctype="multipart/form-data">
          <div class="form-wrap">
            <div class="form-content" half>
              <label class='label'>Email:</label>
              <input type="text" id="email" class="input-form" required />
            </div><!--
        --><div class="form-content" half>
              <label class='label'>Mot de passe:</label>
              <input type="password" id="motdepasse" class="input-form" required />
            </div>
            <input type="hidden" id="dataOffer" value="{{dataOffer.id}}" />
        </div>
				<div class="footer">
					<button class='bouton' design='orange'>Connexion</button>
				</div>
      </form>
    </div>
  </section>






	<section id='inscription' slide state='{{preview3}}'>
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
		  <form id='inscriptionForm' method="post" enctype="multipart/form-data">
		      <div class="form-wrap">
		        <div class="form-content">
		          <label class='label'>Nom:</label>
		          <input type="text" id="nomInscription" class="input-form" required/>
		        </div><!--
		    --><div class="form-content">
		          <label class='label'>Prénom:</label>
		          <input type="text" id="prenomInscription" class="input-form" required/>
		        </div>
		        <div class="form-content">
		          <label class='label'>CV:</label>
							<label for="cvInscription" class='bouton' design='orange'>Choisir un fichier</label>
		          <input type="file" id="cvInscription" style='display: none'/>
		        </div>
		        <div class="form-content">
		          <label class='label'>E-mail:</label>
		          <input type="text" id="emailInscription" class="input-form" required />
		        </div>
            <div class="form-content">
              <label class='label'>Mot de passe:</label>
              <input type="password" id="motdepasseInscription" class="input-form" required/>
            </div>
            <div class="form-content">
              <input type="hidden" id="dataOffer" value="{{dataOffer.id}}" />
            </div>
		    </div>
				<div class="footer">
					<button class='bouton' design='orange' >Inscription</button>
				</div>
		  </form>
    </div>
  </section>


	<section id="testInterface" ng-if='etape == 4'>
    <div class="title">
      <div class="wrap">
        <div class="etape">
          Etape <br>
          {{etape}} sur 5
        </div>
        <div class="text">
          Test de compétences techniques
        </div>
      </div>
    </div>
		<div class="timer" ng-if='beginTest && !FinTest'>
			<div class="barre">
				<div class="cursor" style='height: {{timer/30 * 100}}%'>

				</div>
			</div>
		</div>
		<div class="test-ready f-left" ng-if='FinTest'>
			Résultat du Test: 100%;
		</div>
    <div class="corps">
			<form ng-submit='verifierTest()'>
			<div class="test-ready f-left" ng-if='!beginTest && !FinTest'>
				Etes vous prêt à commencer le test de compétence?
				Durée: <strong>30s</strong>
			</div>
      <div class="test-wrap" ng-if='beginTest && !FinTest'>
					<div class="question" ng-repeat='ques in test_questions'>
						<div class="q-title f-left">
							<div class="q-number">
								{{$index + 1}}
							</div>
							<div class="q-text f-left">
								{{ques.questions.question}}
							</div>
						</div>

						<div class="reponses">
							<div class="reponse" ng-repeat='rep in ques.reponses track by rep.id'>
                <input type='radio' name='question{{rep.id_question}}' ng-model='testFormData[$parent.$index]' required  ng-value='rep'>
							 	<span>{{rep.reponse}}</span>
							</div>
						</div>
					</div>

      </div>
			<div class="footer" ng-if='beginTest && !FinTest'>
				<div class="footer">
					<button class='bouton' type='submit' design='orange' value="sinscrire">VALIDER LE TEST</button>
				</div>
			</div>
			<div class="footer" ng-if='!beginTest && !FinTest'>
				<div class="footer">
					<button class='bouton' ng-click='commencerTest()' design='orange' value="sinscrire">COMMENCER LE TEST</button>
				</div>
			</div>
			<div class="footer" ng-if='FinTest'>
				<div class="footer">
					<button class='bouton' ng-click='getEntretient()' design='orange' value="sinscrire">DEMANDER UN ENTRETIEN</button>
				</div>
			</div>
			</form>
    </div>
  </section>

	<section id="entretient" ng-if='etape == 5' >
    <div class="title">
      <div class="wrap">
        <div class="etape">
          Etape <br>
          {{etape}} sur 5
        </div>
        <div class="text">
          Demande d'entretient
        </div>
      </div>
    </div>
    <div class="corps">
      <div class="choix-entretient f-left">
        Selectionnez une date d'entretient et validez l'envoi

				<img class='img-entretient' src="<?php echo base_url(); ?>assets/img/entretient.png" alt="">
      </div>
			<div class="footer">
				<div class="footer">
					<button class='bouton' design='orange' value="sinscrire">VALIDER L'ENTRETIENT</button>
				</div>
			</div>
    </div>
  </section>



</div>
