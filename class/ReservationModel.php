<?php

class ReservationModel {
    private int $userId;
    private int $activityId;
    private int $reservationid;

    public function __construct(
        int $userId,
        int $activityId,
        int $reservationId
    ) 
    {
        $this->createReservation($userId, $activityId);
        $this->getReservationsByUserId($userId);
        $this->cancelReservation($reservationId);
        
    }

    public function createReservation(int $userId, int $activityId): bool {

    }

    public function getReservationsByUserId(int $userId): array {
        
    }

    public function cancelReservation(int $reservationId): bool {
        
    }

}



?>