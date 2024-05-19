<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova ponuda za vaš oglas</title>
</head>
<body>
    <h1>Ponuda</h1>
    <p>Poštovani {{ $user->name }},</p>
    <p>Dobili ste novu ponudu za vaš oglas</p>
    <p><strong>Cijena ponude:</strong> {{ $listing->price }} EUR</p>
    
    <h3>Podaci o korisniku:</h3>
    <p><strong>Ime:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    
    <h3>Podaci o tvrtci:</h3>
    <p><strong>Naziv trtke:</strong> {{ $company->name }}</p>
    <p><strong>Adresa:</strong> {{ $company->address }}</p>
    <p><strong>Telefon:</strong> {{ $company->phone }}</p>

    @component('mail::button', ['url' => $signedUrl])
        Prihvati ponudu
    @endcomponent
    
    <p>Hvala vam što koristite našu uslugu!</p>
    <p>Srdačno,</p>
    <p>vaš {{ config('app.name') }} tim</p>
</body>
</html>
