$(document).ready(function(){

  // Action on submitting the inscription form
  $(".insform").on("submit", function(event){
    event.preventDefault();
  });

  // Action on submittion the connexion form
  $(".conform").on("submit", function(event){
    event.preventDefault();
    var user = new Object();
    user.pseudo = $("#accConnect").val();
    user.password = $("#rekt").val();
    var userJson = JSON.stringify(user);
    console.log(userJson);
    $("#accConnect").val('');
    $("#rekt").val('');
  });
});
