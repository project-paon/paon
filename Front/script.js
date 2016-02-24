$(document).ready(function(){

  sessionStorage.clear();
  // Action on submitting the inscription form
  $(".insform").on("submit", function(e){
    e.preventDefault();
    var newuser = new Object();
    newuser.pseudo = $("#inspseudo").val();
    newuser['name'] = $("#insname").val();
    newuser.firstname = $("#insfname").val();
    newuser.email = $("#insmail").val();
    newuser.password = $("#inspw").val();


    $.ajax({
      url: 'http://localhost:3000/register',
      type: 'POST',
      data: newuser,
      dataType: 'json',
      success: inscription
    });
  });

  // Action on submittion the connexion form
  $(".conform").on("submit", function(e){
    e.preventDefault();
    var user = new Object();
    user.pseudo = $("#accConnect").val();
    user.password = $("#rekt").val();
    //var userJson = JSON.stringify(user);

      $.ajax({
      url: 'http://localhost:3000/connection',
      type: 'POST',
      data: user,
      dataType: 'json',
      success: connexion
    });
  });
});
var session = "";
var connexion = function(data){
  if (data.statut==="true") {
    sessionStorage.setItem('pseudo', data.pseudo);
    sessionStorage.setItem('session', data.session);
    window.location.replace("timeline.html");
    session = data.session;
  }
  else {
    alert(data.erreur);
  }
};
var inscription = function(data){
  if (data.statut==="true") {
    sessionStorage.setItem('pseudo', data.pseudo);
    sessionStorage.setItem('session', data.session);
    window.location.replace("timeline.html");
    session = data.session;
  }
  else {
    alert(data.erreur);
  }
};
