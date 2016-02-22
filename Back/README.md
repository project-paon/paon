# Le côté back de Paon

 Ci dessous vous trouverez les routes, puis les méthodes de chacune et enfin les code HTTP correspondant à chaque requête, les codes 2.. si la requête aboutie de façon positive, les codes 4.. de façon négative :

- pour l'inscription : /register        POST 200/201 ou 4??
- pour la connexion : /connexion        POST     200 ou 401
- pour la déconnexion : /disconnect     POST     2?? ou 400
- pour la page de tweets : /timeline    POST      200 ou 401
- pour poster un tweet : /tweet         POST     201 ou 4??
- pour retweeter : /retweet
- pour liker un tweet ou pour supprimer un tweet, il s'agira d'un "put" sur la route /tweet.

Toute page méconnue affichera une erreur 400.
