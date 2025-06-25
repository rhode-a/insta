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
