$(document).ready(function() {
  var user = sessionStorage.getItem('pseudo');
  var session = sessionStorage.getItem('session');
  var userAuth = new Object();
  userAuth.session = session;
  userAuth.pseudo = user;

  // Action on submitting a tweet
  $("#postPaon").on("submit", function(e){
    e.preventDefault();
    var paon = new Object();
    paon.message = $('#paonText').val();
    paon.pseudo = user;
    paon.session = session;
    console.log(paon);
    $.ajax({
      url: 'http://localhost:3000/tweet',
      type: 'POST',
      data: paon,
      success: paoned
    })
    $('paonText').val('');
  });

  // Affichage des tweets
  $.ajax({
    url: 'http://localhost:3000/timeline', // La ressource ciblée
    type: 'POST', // Le type de la requête HTTP
    data: userAuth,
    dataType: 'json',
    success: allTweet,
    error: function(yolo, st, er){console.log(yolo, st, er);}
  });

  // Fonction création de tweet
  var paoned = function(data) {
    if (data.statut==="true") {
      location.reload(true);
    }
    else {
      alert(data.erreur);
    }
  }

  // Fonction affichage de tweet
  var allTweet = function(data) {
    console.log("success");
    console.log(data);
    // var obj = $.parseJSON(data);
    for (var item of data){
      var tweetOne = item.img + '<h2>' + item.user_pseudo + '</h2>' + '<br><p class="tweet">' + item.message + '<p>' ;
      $(".paonee").append(tweetOne);
    }
  };
});
