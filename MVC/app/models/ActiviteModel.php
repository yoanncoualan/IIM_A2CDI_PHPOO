<?php
class ActiviteModel extends Bdd
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllActivities(): array
    {
        $stmt = $this->co->prepare('SELECT a.*, t.nom as type_nom FROM activities a INNER JOIN type_activite t ON a.type_id = t.id ORDER BY a.datetime_debut');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivityById(int $id): array
    {
        $stmt = $this->co->prepare('SELECT a.*, t.nom as type_nom FROM activities a INNER JOIN type_activite t ON a.type_id = t.id WHERE a.id = :id');
        $stmt->execute(['id' => $id]);
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);
        return $activity ? $activity : [];
    }

    public function getPlacesLeft(int $id): int
    {
        $stmt = $this->co->prepare('SELECT places_disponibles FROM activities WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$activity) {
            return 0;
        }

        $stmt = $this->co->prepare('SELECT COUNT(*) as reserved FROM reservations WHERE activite_id = :id AND etat = TRUE');
        $stmt->execute(['id' => $id]);
        $reserved = $stmt->fetch(PDO::FETCH_ASSOC);

        $placesLeft = $activity['places_disponibles'] - (int)$reserved['reserved'];
        return max(0, $placesLeft);
    }
}

