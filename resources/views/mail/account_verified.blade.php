@component('mail::message')
# Korisnički račun potvrđen

Naš tim potvrdio je vaš korisnički račun!
Prijavljujete se sa ovom i e-mail adresom i danom lozinkom.

Lozinka: {{ $password }}
Preporučamo da privremenu lozinku promijenite nakon prve prijave.


Zahvaljujemo na korištenju naše platforme,<br>
Vaš {{ config('app.name') }} tim
@endcomponent
