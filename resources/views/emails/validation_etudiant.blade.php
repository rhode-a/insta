<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Validation de votre préinscription</title>
</head>
<body>
    <h2>Bonjour {{ $etudiant->prenom }} {{ $etudiant->nom }},</h2>

    <p>Votre préinscription a été validée avec succès.</p>

    <p><strong>⚠️ Vous disposez d'un délai d'une semaine pour finaliser votre inscription.</strong><br>
    Passé ce délai, votre compte pourra être <strong>supprimé automatiquement</strong>.</p>

    <p>Merci de compléter les informations restantes dans les plus brefs délais.</p>

    <p>Cordialement,<br>
    L'équipe T.T.G Network</p>
</body>
</html>
