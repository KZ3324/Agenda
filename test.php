<?php

use App\Application\UseCase\CreateBookingUseCase;
use App\Infrastructure\Persistence\InMemory\InMemoryBookingRepository;

require_once('vendor/autoload.php');

// 1. On prépare les outils
$repository = new InMemoryBookingRepository();
$useCase = new CreateBookingUseCase($repository);

try {
    // 2. On tente de créer une réservation valide
    echo "Test 1 : Création valide... ";
    $booking = $useCase->execute("Jean Dupont", "2026-06-01", "2026-06-10");
    echo "Réussi ! Statut : " . $booking->getStatus() . "\n";

    // 3. On vérifie si c'est bien dans notre "fausse" BDD
    if ($repository->findById($booking->getId())) {
        echo "Vérification : Réservation bien sauvegardée en mémoire.\n";
    }

    // 4. On tente de créer une réservation INVALIDE (date début > date fin)
    echo "Test 2 : Dates invalides... ";
    $useCase->execute("Mauvais Client", "2026-06-20", "2026-06-10");

} catch (\Exception $e) {
    echo "Capturé avec succès : " . $e->getMessage() . "\n";
}