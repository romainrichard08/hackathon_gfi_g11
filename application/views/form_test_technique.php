<h1>Test technique</h1>

<form method="POST" action="#">
<input type="hidden" name="question" value="">
<table>
	<?php
		// Affiche les questions
		foreach ($result as $row)
		{	
			echo "<tr><td>";
			echo $row[0]->question;
			echo "</td></tr>";

			//Affiche les reponses
			echo "<tr><td>";

			foreach ($row[1] as $key => $value) 
			{
				echo "<input type='radio' name='question".$value->id_question."' value='".$value->reponse."' />";
				echo $value->reponse;
			}
			echo "</td></tr>";
		}
	?>
	<tr><td>
	<button type="submit">Valider le test</button>
	</td></tr>

</table>
</form>



