$(document).ready(function(){

  // Action on submitting the inscription form
  $(".insform").on("submit", function(e){
    console.log("ins");
    e.preventDefault();
    var newuser = new Object();
    newuser.pseudo = $("#inspseudo").val();
    newuser.name = $("#insname").val();
    newuser.firstname = $("#insfname").val();
    newuser.email = $("#insmail").val();
    newuser.password = $("#inspw").val();
    var newuserJson = JSON.stringify(newuser);
    console.log(newuserJson);
  });

  // Action on submittion the connexion form
  $(".conform").on("submit", function(e){
    e.preventDefault();
    var user = new Object();
    user.pseudo = $("#accConnect").val();
    user.password = $("#rekt").val();
    var userJson = JSON.stringify(user);
    console.log(userJson);
    $("#accConnect").val('');
    $("#rekt").val('');
    $.ajax({
      url: '/register',
      type: 'POST',
      data: userJson,
      dataType: 'JSON',
      success: connexion
    })
  });
});
