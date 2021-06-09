<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>
<body ng-app data-new-gr-c-s-check-loaded="14.1012.0" data-gr-ext-installed>
   <main>
       <section>
           <h2 class="form-signin-heading">
               Autenticacion de usuario
           </h2>
           <div class="container">
               <div id="formContent">
                   <div class="form-signin-heading">
                       ICONO
                   </div>
                   <form class="form-signin">
                       <label for="login" class="sr-only">Usuario</label>
                       <input type="text" id="login" class="form-control" name="login" placeholder="login">
                       <label for="password" class="sr-only">Clave</label>
                       <input type="text" id="password" class="form-control" name="login" placeholder="password">
                       <input type="submit" class="btn btn-lg btn-primary btn-block"  value="Log In">
                   </form>
                   <div class="checkbox">
                       <a  href="#">Forgot Password?</a>
                   </div>

               </div>
           </div>
       </section>
   </main>
</body>
</html>