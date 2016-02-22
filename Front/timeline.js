$(document).ready(function() {
  $.ajax({
    url: '/timeline', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP
    dataType: 'json' // Le type de données à recevoir
    success: allTweet
  });

  Fonction affichage de tweet
  var allTweet = function(data) {
    // var obj = $.parseJSON(data);
    for (var item of data){
      var tweetOne = item.img + '<h2>' + item.user_pseudo + '</h2>' + '<br><p class="tweet">' + item.message + '<p>' ;
      $("#tweets").append(tweetOne);
    }
  };
