<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;

// Chemin vers le fichier service account
$serviceAccountPath = __DIR__ . '/config/firebase/firebase_credentials.json'; // ajuste le nom si nécessaire

try {
    $factory = (new Factory)->withServiceAccount($serviceAccountPath);

    $auth = $factory->createAuth();

    echo "✅ Connexion à Firebase réussie ! Auth prêt à être utilisé.";
} catch (\Throwable $e) {
    echo "❌ Erreur de connexion à Firebase : " . $e->getMessage();
}
