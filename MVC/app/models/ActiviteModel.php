<?php
class ActiviteModel extends Bdd
{
    // Appelle le constructeur de la classe parente (Bdd) pour établir la connexion $this->co.
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère toutes les activités avec le nom de leur type.
     */
    public function getAllActivities(): array
    {
        $stmt = $this->co->prepare('SELECT a.*, t.nom as type_nom FROM activities a INNER JOIN type_activite t ON a.type_id = t.id ORDER BY a.datetime_debut');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une activité par son ID (avec jointure pour le type).
     * @param int $id ID de l'activité.
     * @return array Les données de l'activité ou [] si non trouvée.
     */
    public function getActivityById(int $id): array
    {
        $stmt = $this->co->prepare('SELECT a.*, t.nom as type_nom FROM activities a INNER JOIN type_activite t ON a.type_id = t.id WHERE a.id = :id');
        $stmt->execute(['id' => $id]);
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);
        return $activity ? $activity : [];
    }

    /**
     * Calcule le nombre de places restantes : (Places Max) - (Réservations confirmées).
     * @param int $id ID de l'activité.
     * @return int Le nombre de places disponibles.
     */
    public function getPlacesLeft(int $id): int
    {
        // Récupérer le total des places.
        $stmt = $this->co->prepare('SELECT places_disponibles FROM activities WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$activity) {
            return 0; // Activité non trouvée.
        }

        // Compter les réservations validées (etat = TRUE).
        $stmt = $this->co->prepare('SELECT COUNT(*) as reserved FROM reservations WHERE activite_id = :id AND etat = TRUE');
        $stmt->execute(['id' => $id]);
        $reserved = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calcul et sécurité pour ne pas retourner de valeur négative.
        $placesLeft = $activity['places_disponibles'] - (int)$reserved['reserved'];
        return max(0, $placesLeft);
    }
}