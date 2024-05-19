@component('mail::message')
# Korisnički račun potvrđen

Vaša lozinka je resetirana!

Lozinka: {{ $password }}
Preporučamo da lozinku promijenite nakon sljedeće prijave.

Zahvaljujemo na korištenju naše platforme,<br>
Vaš {{ config('app.name') }} tim
@endcomponent
