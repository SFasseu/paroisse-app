<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Ajouter Contact</title>
</head>
<body>
          <div class="card-body px-lg-5 py-4">
                <form action="{{route('contact.store') }}" enctype="multipart/form-data" method="post" style="text-align: center;border:2px solid black ;" >
                    @csrf

                   <h1>formulaire d'ajout</h1>

                    <label for="name">name</label><br>
                    <input type="text" name="name"><br><br>

                    <label for="email">email</label><br>
                    <input type="email" name="email"><br><br>

                    <label for="adresse">adresse</label><br>
                    <input type="text" name="adress"><br><br>

                    <button type="submit">Ajouter</button>
                    
                </form>
            </div>
</body>
</html>