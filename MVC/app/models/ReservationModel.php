<?php

class ReservationModel extends Bdd
{

    // Appelle le constructeur de la classe parente (Bdd) pour établir $this->co.
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Crée une nouvelle réservation. 
     * @param int $userId ID de l'utilisateur.
     * @param int $activityId ID de l'activité.
     * @return bool Succès de l'insertion.
     */
    public function createReservation(int $userId, int $activityId): bool
    {
        $stmt = $this->co->prepare('INSERT INTO reservations (user_id, activite_id) VALUES (:user_id, :activite_id)');
        return $stmt->execute([
            'user_id' => $userId,
            'activite_id' => $activityId
        ]);
    }

    /**
     * Récupère toutes les réservations d'un utilisateur donné.
     * @param int $userId ID de l'utilisateur.
     * @return array Liste des réservations (actives ou annulées).
     */
    public function getReservationsByUserId(int $userId): array
    {
        $stmt = $this->co->prepare('SELECT * FROM reservations WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Annule une réservation en mettant son état à FALSE.
     * @param int $reservationId ID de la réservation à annuler.
     * @return bool Succès de la mise à jour.
     */
    public function cancelReservation(int $reservationId): bool
    {
        $stmt = $this->co->prepare('UPDATE reservations SET etat = FALSE WHERE id = :id');
        return $stmt->execute(['id' => $reservationId]);
    }
}