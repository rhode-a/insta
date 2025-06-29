@component('mail::message')
# Confirmation de votre préinscription

Bonjour **{{ $preinscription->prenom }} {{ $preinscription->nom }}**,

Nous avons bien reçu votre demande de préinscription au sein de **T.T.G Network**.

---

### Vos informations :

- **Nom complet :** {{ $preinscription->prenom }} {{ $preinscription->nom }}
- **Email :** {{ $preinscription->email }}
- **Téléphone :** {{ $preinscription->telephone }}
- **Niveau choisi :** {{ $preinscription->niveau }}
- **Option choisie :** {{ $preinscription->option }}

---

Nous vous remercions pour votre confiance.  
Un administrateur va examiner votre dossier et vous contactera rapidement.

Votre dossier a été correctement reçu et sera traité dans un délai maximum de 48 heures. Nous vous invitons à vous rapprocher de la direction avant l'expiration d'un délai de 2 semaines pour finaliser votre inscription. Passé ce délai, votre préinscription sera automatiquement annulée.

@component('mail::button', ['url' => url('/')])
Visitez notre site
@endcomponent

Merci,<br>
**L’équipe T.T.G Network**

{{-- Pied de page --}}
@slot('footer')
© {{ date('Y') }} T.T.G Network. Tous droits réservés.
@endslot
@endcomponent
