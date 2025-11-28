<?php

class ReservationController {
    private int $activityId;
    private int $id;

    public function __construct(
        int $activityId,
        int $id
        
    ) 
    {
        $this->create($activityId);
        $this->show($id);
        $this->cancel($id);
      
    }

    public function index() {

    }

    public function create(int $activityId) {
        
    }

    public function show(int $id) {
        
    }

    public function cancel(int $id) {
        
    }

}



?>