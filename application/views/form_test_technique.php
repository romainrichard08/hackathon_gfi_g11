<h1>Test technique</h1>

<form>
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
				echo "<input type='radio' name='question".$value->id."' />";
				echo $value->reponse;
			}
			echo "</td></tr>";
		}
	?>
	<tr><td>
	<button type='submit' value='Valider le test'>Valider le test</button>
	</td></tr>

</table>
</form>



