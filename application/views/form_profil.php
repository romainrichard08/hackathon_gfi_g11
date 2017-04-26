<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Bienvenue sur l'espace Carrières de GFI</h1>

	<form action="#" method="post">
		<fieldset>
		<legend>Dans quelle branche souhaitez-vous nous rejoindre?</legend>
		<select id="branche" required>
		  <option value="Commercial">Commercial</option>
		  <option value="Informatique">Informatique</option>
		  <option value="Ressources-humaines">Ressources Humaines</option>
		</select>

		<legend>Quel type de contrat recherchez-vous?</legend>
		<select id="contrat" required>
		  <option value="CDI">CDI</option>
		  <option value="CDD">CDD</option>
		  <option value="Stage">Stage</option>
		  <option value="Alternance">Stage</option>
		</select>

		<legend>Quelles compétences avez-vous? (Entrée pour ajouter)</legend>
		<div id='ajout-tag-wrap' class='input-form f-left'>
        <ul class='u-t-input f-left w-100 h-auto'>

            <input class='inputTagsText f-left' type='text' placeholder='Compétence...'>
        </ul>
        <ul class='searchResult'>

        </ul>
    </div>
    <input id='uploadTagsValues' type='text' name='tags' style='display:none;'>

		<button type="submit" class='bouton' design='blanc' value="Rechercher">Rechercher</button>
		</fieldset>
	</form>


	<script type="text/javascript">
		// function rechercheTags(text)
		// {
		// 	$.ajax({
		// 		url: "<?php echo site_url('Home'); ?>home/search",
		// 		datatype:"json",
		// 		method:'POST',
		// 		data:{tag: text},
		// 		async:false,
		// 		success:function(data)
		// 		{
		// 			if (data !== "") { data = JSON.parse(data)};
		// 			result = data;
		// 			console.log(data);
		// 		}
		// 	});
		// 	return result;
		// }
	</script>
