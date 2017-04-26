$(document).ready(function() {

listResultTag = ""; // stocker les tag recus
listTagSelected = []; // stocker la liste de tag a envoyer
resultSelected = 0;

docRoot = '/hackathon_gfi_g11/';



  $("#ajout-tag-wrap").click(function(){
		$("body").find(".inputTagsText").focus();
	})


  $("body").on('click', '.searchResultItem', function(event){
    var id = $(this).attr('idTag');
    var label = $(this).text().trim();
    ajouterItemTag({id: id, label: label}, listTagSelected);
  })


	$("body").on('keydown','.inputTagsText',function(event){
		var touche = event.which;
		var text = $(this).val();
		if (touche == 38 || touche == 40)
		{
			event.preventDefault();
		}
		if (touche == 13) {
			event.preventDefault();
		}
		if (touche == 32)
		{
			event.preventDefault();
		}

		else if (touche == 8 && text == "") {
			if (listTagSelected.length > 0) {
				var tag = "#itemTag" + (listTagSelected.length - 1);
				supprimerItemTag(tag, event);
			};
		}
	})

	$("body").on('keyup','.inputTagsText',function(event){
		var touche = event.which;
		var text = $(this).val();

		// Appui touche entrée
		if ((touche == 13 || touche == 32) && text != "")
		{
			if (listResultTag == "" || resultSelected == -1) {
				// ajouterItemTag({label: text}, listTagSelected);
			}
			else
			{
				listTagSelected = ajouterItemTag(listResultTag[resultSelected], listTagSelected);
			}
		}

		// appui touche fléchées haut et bas
		else if (touche == 38 || touche == 40)
		{
			event.preventDefault();
			if ((touche == 38 && resultSelected > 0) || (touche == 40 && resultSelected < listResultTag.length - 1))
			{
				var direction = (- 39) + touche;
				$("#tagResult" + resultSelected).attr("select", 'false');
				resultSelected += direction;
				$("#tagResult" + resultSelected).attr("select", 'true');
			};
		}

		// appui autres touches (a ajouter après: echap,delete etc..)
		else
		{
			$(".searchResult").html("");
			if (text != "" && text.length > 0) {
        listResultTag = rechercheTags(text);
			}
      else{
        listResultTag = "";
      }
			if (listResultTag != "" && listResultTag != null) {
				var index = 0;
				for(var i = 0; i < listResultTag.length; i++)
				{
					var verify = verifyExistence(listTagSelected, listResultTag[i]);
					if (verify) {
						var template = "<li idTag='"+listResultTag[i].id+"' id='tagResult" + index + "' select='false' class='searchResultItem f-left'>\
									<span>" + listResultTag[i].label + "</span>\
									</li>"
						$(".searchResult").append(template);
						index++;
					}
					else
					{
						listResultTag.splice(i, 1);
						i--;
					}
				}
				resultSelected = -1;
				// $("#tagResult0").attr("select", "true");
				$(".searchResult").show();
        resultSelected ++;
				$("#tagResult" + resultSelected).attr("select", 'true');
			}
			else
			{
				$(".searchResult").hide();
			}
		}

	})

});


function supprimerItemTag(item, event){
  event.stopPropagation();
  var id = $(item).parent().attr('id');
  var label = $(item).siblings($('span')).text();
  var index = indexInList(listTagSelected,label);
  var DivSize = $("#ajout-tag-wrap").outerWidth();
  $("#" + id).remove();
  $(item).remove();
  listTagSelected.splice(index , 1);
  var template = "";
  $.each(listTagSelected, function(i, item)
  {
    template += item.id + "/";
  })
  $("#uploadTagsValues").val(template);
  $(".inputTagsText").val("").width(1);
  var position = $(".inputTagsText").position().left + 10;
  if (position > (DivSize - 80)) { position = 15};
  $(".inputTagsText").css("width","calc(100% - " + position + "px)")
}

function indexInList(list, item){
    var index = 0;
    for (var i = 0; i < list.length; i++)
    {
      if (list[i].id == item.id) {
        return i;
      };
    };
    return -1;
  }


function ajouterItemTag(item, listTag){
  list = listTag;
  var verify = verifyExistence(list, item);
  if (verify) {
    list.push(item);
    var index = list.length - 1;
    var DivSize = $("#ajout-tag-wrap").outerWidth();
    console.log(DivSize);

    var template = "<li id='itemTag" + index + "' class='tag'>\
              <span>" + item.label + "</span> \
              <img class='t-u-delete' src='"+ docRoot + "assets/img/deleteWhite.png' onclick='supprimerItemTag(this, event)' height='15' width= '15'>\
            </li>";
    $(".inputTagsText").val("").width(1).before(template);
    var position = $(".inputTagsText").position().left + 10;
    if (position > (DivSize - 80)) { position = 15};
    $(".inputTagsText").css("width","calc(100% - " + position + "px)")
    listResultTag = "";
    $(".searchResult").hide().html("");
  }
  var template = "";
  $.each(list, function(i, item)
  {
    template += item.id + "/";
  })
  listResultTag = '';
  $("#uploadTagsValues").val(template);
  return list;
}

var result;
function rechercheTags(text)
{
  $.ajax({
    url: docRoot+ "indexController/search",
    datatype:"json",
    method:'POST',
    data:{tag: text},
    async:false,
    success:function(data)
    {
      console.log(data);
      if (data !== "") { data = JSON.parse(data)};
      result = data;

    }
  });
  return result;
}

function verifyExistence(list, item){
  var test = true;
  for (var i = 0; i < list.length; i++)
  {
    if (list[i].id == item.id) {
      test = false;
    };
  };

  return test;
}
