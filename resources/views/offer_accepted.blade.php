<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponuda Prihvaćena</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mx-auto">
            <div class="card-header text-center">
                <h2>Ponuda Prihvaćena</h2>
            </div>
            <div class="card-body text-center">
                <h4 class="card-title">Čestitamo!</h4>
                <p class="card-text">Vaša ponuda za listing <strong>{{ $offer->listing->title }}</strong> je uspješno prihvaćena.</p>
                <p class="card-text">Cijena ponude: <strong>{{ $offer->price }} EUR</strong></p>

                <div class="mt-4">
                    <h5>Podaci o korisniku:</h5>
                    <p>Ime: {{ $offer->user->name }}</p>
                    <p>Email: {{ $offer->user->email }}</p>
                </div>

                <div class="mt-4">
                    <h5>Podaci o kompaniji:</h5>
                    <p>Naziv kompanije: {{ $offer->user->company->name }}</p>
                    <p>Adresa: {{ $offer->user->company->address }}</p>
                    <p>Telefon: {{ $offer->user->company->phone }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
