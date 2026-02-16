<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <form action="{{ Route('contact.store') }}" method="post">
                <div class="group">
                    <label for="name">Nom complet:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="group">
                    <label for="phone">Numero de telephone</label>
                    <input type="number" name="phone" id="phone" required>
                </div>
                <div class="group">
                    <label for="address">Nom complet:</label>
                    <input type="eamil" name="email" id="email">
                </div>
                <div class="group">
                    <label for="name">Adresse :</label>
                    <input type="text" name="address" id="address" required>
                </div>
                <div class="group btn">
                    <input type="submit" value="Enregistrer" class="btn sub">
                    <input type="reset" value="Annuler" class="btn res">
                </div>
            </form>
        </div>
    </div>
</body>
</html>