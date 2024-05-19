<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponuda Prihvaćena</title>
</head>
<body>
    <h1>Ponuda Prihvaćena</h1>
    <p>Poštovani {{ $user->name }},</p>
    <p>Vaša ponuda za listing <strong>{{ $listing->title }}</strong> je uspješno prihvaćena.</p>
    <p><strong>Cijena ponude:</strong> {{ $listing->price }} EUR</p>
    
    <h3>Podaci o korisniku:</h3>
    <p><strong>Ime:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    
    <h3>Podaci o kompaniji:</h3>
    <p><strong>Naziv kompanije:</strong> {{ $company->name }}</p>
    <p><strong>Adresa:</strong> {{ $company->address }}</p>
    <p><strong>Telefon:</strong> {{ $company->phone }}</p>
    
    <p>Hvala vam što koristite našu uslugu!</p>
    <p>Srdačno,</p>
    <p>vaš {{ config('app.name') }} tim</p>
</body>
</html>
