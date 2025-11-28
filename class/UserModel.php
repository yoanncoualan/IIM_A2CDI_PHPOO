<?php

class UserModel {
    private string $email;
    private string $motdepasse;
    private bool $data;

    public function __construct(
        string $email,
        string $motdepasse,
        bool $data
    ) 
    {
        $this->logUser($email, $motdepasse);
        $this->createUser($data);
    }

    public function logUser(string $email, string $motdepasse): array {

    }

    public function createUser(array $data): bool {
        
    }

    public function getAllUsers(): array {
        
    }

}



?>