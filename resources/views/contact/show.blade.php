<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h2>detail du contact</h2>
    <p><strong>Nom :</strong>{{ $contact->name }}</p>
    <p><strong>Email :</strong>{{ $contact->name }}</p>
    <p><strong>Address:</strong>{{ $contact->name }}</p>
    <a href="{{ 'contact.index' }}"><button>Retour</button></a>
    
    
</body>
</html>
