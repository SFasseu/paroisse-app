<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="{{asset('css/form-contact.css')}}">
</head>
<body>
    <div class="container">
        <div class="form-group">
            <h2>Edit conntact</h2>
            <form action="{{ Route('contact.update') }}" method="get">
                <div class="group">
                    <label for="name">Nom complet:</label>
                    <input type="text" name="name" id="name" required value="{{ $contact->name }}">
                </div>
                <div class="group">
                    <label for="phone">Numero de telephone</label>
                    <input type="number" name="phone" id="phone" required value="{{ $contact->phone }}">
                </div>
                <div class="group">
                    <label for="address">Email:</label>
                    <input type="eamil" name="email" id="email" value="{{ $contact->email }}">
                </div>
                <div class="group">
                    <label for="name">Adresse :</label>
                    <input type="text" name="address" id="address" required value="{{ $contact->address }}">
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