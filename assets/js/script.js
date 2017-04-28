var MainApp = angular.module('gfi',[]);

MainApp.controller('jobs', ['$scope', function ($scope) {

$scope.jobs = [];
$scope.showJobs = false;
$scope.dataOffer;
$scope.etape = 1;
$scope.previewGlobal = false;
$scope.preview1 = false;
$scope.preview2 = false;
$scope.preview3 = false;

$scope.testFormData = [];
docRoot = '/hackathon_gfi_g11/';
var result;

$scope.onglets = [
  {id: "form", img: "step1", etape: 1},
  {id: "search", img: "step2", etape: 2},
  {id: "inscription", img: "step3", etape: 3},
  {id: "test", img: "step4", etape: 4},
  {id: "results", img: "step5", etape: 5},
]

$scope.closePreview = function(){
  $scope.previewGlobal = false;
  $scope.preview1 = false;
  $scope.preview2 = false;
  $scope.preview3 = false;
  $(".sectionContain").scrollTop(0);
}


$scope.changeView = function(onglet, event){
  if ($scope.previewGlobal && onglet.etape == $scope.etape) {
    $scope.closePreview();
  }
  else if (onglet.etape == 2 && onglet.etape > $scope.etape && $scope.jobs.length > 0) {
    $scope.etape = onglet.etape;
    $scope.closePreview();
  }
  else if(onglet.etape < $scope.etape){
    $scope.etape = onglet.etape;
    $scope.closePreview();
  }
}


$scope.openOffer = function(offer, event, index){
  event.stopPropagation();
  $scope.dataOffer = offer;
  $scope.previewGlobal = true;
  $scope.preview1 = true;
  $scope.dataOffer.index = index;
}


$scope.displayTest = function(id){
  $.ajax({
    url: docRoot+ "OfferController/testTechnique",
    datatype:"json",
    method:'POST',
    data:{idOffer: id},
    async:false,
    success:function(data)
    {
      data = JSON.parse(data);

      $.each(data,function(index, el) {
        // data[index] = [];
        data[index] = [];
        data[index]["questions"] = el[0];
        data[index]["reponses"] = el[1];
        $scope.testFormData.push({})
      });
      console.log(data);
      $scope.test_questions = data;
    }
  });
}










listResultTag = ""; // stocker les tag recus
listTagSelected = []; // stocker la liste de tag a envoyer
resultSelected = 0;
setTimeout(function(){
  branche = $('#branche').val();
})

$("body").on('change','#branche',function() {
  branche = $('#branche').val();
  $("#uploadTagsValues").val("");
  listResultTag = "";
  listTagSelected = [];
  resultSelected = 0;
  $("#ajout-tag-wrap").html(`<ul class='u-t-input f-left w-100 h-auto'>

      <input class='inputTagsText f-left' type='text' placeholder='Compétence...'>
  </ul>
  <ul class='searchResult'>

  </ul>`);
});




$('body').on('submit','#searchJob',function(event){
  event.preventDefault();
  var form = {};
  form.branche = $('#branche').val();
  form.contrat = $('#contrat').val();
  form.localisation = $('#localisation').val();
  var competences = $("#uploadTagsValues").val();
  form.competences = competences.slice(0, competences.length - 1);
  $scope.showJobs = false;
  $scope.jobs = [];
  $scope.etape = 2;
  $scope.$apply();
  findJobs(form);
})

$('body').on('click', '.t-u-delete', function(event){
  supprimerItemTag(this, event);
})





$("body").on('click','#ajout-tag-wrap',function(){
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
      listResultTag = rechercheTags(branche, text);
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

function findJobs(form)
{
  $(".windowLoad").show();
  $.ajax({
    url: docRoot+ "indexController/findJobs",
    datatype:"json",
    method:'POST',
    data:form,
    async:false,
    success:function(data)
    {
      result = JSON.parse(data);
      var final_offer = [];

      $.each(result, function(index, o) {
          var good = true;
          $.each(final_offer, function(index2, f) {
            if(f.id == o.id){
              good = false;
              f.label.push(o.label);
            }
          });
          if (good) {
            o.label = [o.label];
            final_offer.push(o);
          }
      });
      setTimeout(function(){
        $(".windowLoad").hide();
        $scope.jobs = final_offer;
        $scope.showJobs = true;
        $scope.$apply();
      },2000);
    }
  });
  return result;
}







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

    var template = "<li id='itemTag" + index + "' class='tag'>\
              <span>" + item.label + "</span> \
              <img class='t-u-delete' src='"+ docRoot + "assets/img/deleteWhite.png' height='18' width= '18'>\
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

function rechercheTags(branche, text)
{
  $.ajax({
    url: docRoot+ "indexController/search",
    datatype:"json",
    method:'POST',
    data:{tag: text, branche: branche},
    async:false,
    success:function(data)
    {
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

$("body").on('click','.offer',function(){
  idOffer = $(this).attr('idOffer');

  $.ajax({
    url: docRoot+ "OfferController/index",
    datatype:"json",
    method:'POST',
    data:{idOffer: idOffer},
    async:false,
    success:function(data)
    {
      console.log(data);
      if (data !== "") {
        data = JSON.parse(data)
      };
      $scope.dataOffer = data;
      $scope.$apply();

      $('#offer').css('display', 'block');
    }
  });
});

$scope.candidateInterface = function(dataOffer, event){
  $scope.closePreview();

  $scope.etape = 3;
  var dataOffer = dataOffer;

  //alert(dataOffer);

  $('#popup').css('display', 'none');

}


$scope.goToConnexion = function(dataOffer, event){
  $scope.previewGlobal = true;
  $scope.preview2 = true;

}


$scope.goToInscription = function(dataOffer, event){
  $scope.previewGlobal = true;
  $scope.preview3 = true;
}


$('body').on('submit','#connexionForm',function(event){
  event.preventDefault();
  var form = {};
  form.email = $('#email').val();
  form.motdepasse = $('#motdepasse').val();
  form.dataOffer = $('#dataOffer').val();
  var idOffer = $('#dataOffer').val();


  $scope.$apply();
  $.ajax({
    url: docRoot+ "ConnexionController/index",
    datatype:"json",
    method:'POST',
    data:{form: form},
    async:false,
    success:function(data){
      if(data === 'NO'){
        alert('UTILISATEUR INCONNU');
      } else {
        $scope.closePreview();

        $scope.etape = 4;



        // JAI RECUP LA FONCTION DISPLAYTEST ET JE LAI MISE ICI
        $.ajax({
          url: docRoot+ "OfferController/testTechnique",
          datatype:"json",
          method:'POST',
          data:{idOffer: idOffer},
          async:false,
          success:function(data)
          {
            data = JSON.parse(data);

            $.each(data,function(index, el) {
              // data[index] = [];
              data[index] = [];
              data[index]["questions"] = el[0];
              data[index]["reponses"] = el[1];
              $scope.testFormData.push({});
            });
            console.log(data);
            $scope.test_questions = data;

            }
          });
        }
      }
    });
  });

}]);
