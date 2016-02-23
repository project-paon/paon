$(document).ready(function() {
  var user = sessionStorage.getItem('pseudo');
  var session = sessionStorage.getItem('session');
  console.log(user);
  console.log(session);

  // Action on submitting a tweet
  $(".postPaon").on("submit", function(e){
    e.preventDefault();
    var paon = new Objext();
    paon.message = $('paonText').val();
    paon.pseudo = user;
    paon.session = session;
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
    url: '/timeline', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP
    dataType: 'json', // Le type de données à recevoir
    success: allTweet
  });

  // Fonction création de tweet
  var paoned = function(data) {
    // A faire
    // retourne la liste de tweet actualisée
  }

  // Fonction affichage de tweet
  var allTweet = function(data) {
    // var obj = $.parseJSON(data);
    for (var item of data){
      var tweetOne = item.img + '<h2>' + item.user_pseudo + '</h2>' + '<br><p class="tweet">' + item.message + '<p>' ;
      $("#tweets").append(tweetOne);
    }
  };
});
