$(document).ready(function() {
  var user = sessionStorage.getItem('pseudo');
  var session = sessionStorage.getItem('session');
  var userAuth = new Object();
  userAuth.session = session;
  userAuth.pseudo = user;

  // Fonction création de tweet
  var paoned = function(data) {
    if (data.statut==="true") {
      location.reload(true);
    }
    else {
      alert(data.erreur);
    }
  };

  // Fonction affichage de tweet
  var allTweet = function(data) {
    console.log("success");
    console.log(data);
    // var obj = $.parseJSON(data);
    for (var item of data){
      var tweetOne = '<h2>' + item.pseudo + '</h2>' + '</br><p class="tweet">' + item.message + '<p>' + '</br><p>Likes :' + item.like_nb + '</p>' + '<p>Repaons :' + item.rt_nb + '</p>';
      $(".paonee").append(tweetOne);
    }
  };

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
  console.log("GET timeline");
  console.log(allTweet);
  $.ajax({
    url: 'http://localhost:3000/timeline', // La ressource ciblée
    type: 'POST', // Le type de la requête HTTP
    data: userAuth,
    dataType: 'json',
    contentType: 'application/json',
    success: allTweet,
    error: function(yolo, st, er){
      console.log("error timeline");
      console.log(yolo, st, er);}
  });


});
