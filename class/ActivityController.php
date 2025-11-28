<?php

class ActivityController {
    private int $id;
    private string $data;

    public function __construct(
        int $id,
        array $data
        
    ) 
    {
        $this->show($id);
        $this->update($id, $data);
        $this->delete($id);
      
    }

    public function index() {

    }

    public function show(int $id) {
        
    }

    public function update(int $id, array $data) {
        
    }

    public function delete(int $id) {
        
    }

}



?>