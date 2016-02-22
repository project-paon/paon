$(document).ready(function(){

  // Action on submitting the inscription form
  $(".insform").on("submit", function(e){
    e.preventDefault();
    var newuser = new Object();
    newuser.pseudo = $("#inspseudo").val();
    newuser['name'] = $("#insname").val();
    newuser.firstname = $("#insfname").val();
    newuser.email = $("#insmail").val();
    newuser.password = $("#inspw").val();
    var newuserJson = JSON.stringify(newuser);
    $.ajax({
      url: 'http://localhost:3000/register',
      type: 'POST',
      data: newuserJson,
      dataType: 'json',
      success: inscription
    })

  });

  // Action on submittion the connexion form
  $(".conform").on("submit", function(e){
    e.preventDefault();
    var user = new Object();
    user.pseudo = $("#accConnect").val();
    user.password = $("#rekt").val();
    var userJson = JSON.stringify(user);
    console.log(userJson);
      $.ajax({
      url: 'http://localhost:3000/connection',
      type: 'POST',
      data: userJson,
      dataType: 'json',
      success: connexion
    })
  });
});
var connexion = function(data){
  if (data.statut==="true") {
    window.location.replace("timeline.html");
    var session = data.session;
  }
  else {
    alert(data.erreur);
  }
};
var inscription = function(data){
  if (data.statut==="true") {
    window.location.replace("timeline.html");
    var session = data.session;
  }
  else {
    alert(data.erreur);
  }
};
