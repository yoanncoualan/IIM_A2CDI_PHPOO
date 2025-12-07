<?php
require_once './app/utils/Render.php';

class ReservationController
{
    // ajout du trait Render pour gerer l'affichage des vues
    use Render;

    // page liste des reservations de utilisateur 
    public function index(): void
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: /user/login");
            exit;
        }

        $reservationModel = new ReservationModel();
        // recupere toutes les reservations de utilisateur connectee
        $reservations = $reservationModel->getReservationsByUserId($_SESSION['id']);

        $this->renderView('reservations/index', [
            'reservations' => $reservations
        ], 'index');
    }

      // creation d'une reservation 
    public function create(int $activityId): void
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: /user/login");
            exit;
        }

        $reservationModel = new ReservationModel();
        // creee une reservation pour utilisateur pour une activite donnee
        $reservationModel->createReservation($_SESSION['id'], $activityId);

        header("Location: /reservation");
        exit;
    }

     // affichage d'une reservation specifique 
    public function show(int $id): void
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: /user/login");
            exit;
        }

        $reservationModel = new ReservationModel();
        $co = $reservationModel->getCo();
        // recupere la reservation par son id
        $stmt = $co->prepare('SELECT * FROM reservations WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($reservation) || $reservation['user_id'] != $_SESSION['id']) {
            header("Location: /reservation");
            exit;
        }

         // affiche la vue show
        $this->renderView('reservations/show', [
            'reservation' => $reservation
        ], 'index');
    }

    // annulation d'une reservation 
    public function cancel(int $id): void
    {
        session_start();
        // verifie connexion utilisateur
        if (!isset($_SESSION['id'])) {
            header("Location: /user/login");
            exit;
        }

        $reservationModel = new ReservationModel();
        $co = $reservationModel->getCo();
        // verifie que la reservation existe et appartient utilisateur
        $stmt = $co->prepare('SELECT * FROM reservations WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($reservation) || $reservation['user_id'] != $_SESSION['id']) {
            header("Location: /reservation");
            exit;
        }
        // appelle la methode du modele pour annuler
        $reservationModel->cancelReservation($id);
        header("Location: /reservation");
        exit;
    }

     // liste des reservations si admin 
    public function list(): void
    {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $reservationModel = new ReservationModel();
        $co = $reservationModel->getCo();
         // recupere toutes les reservations de tous utilisateurs
        $stmt = $co->prepare('SELECT * FROM reservations');
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // affiche la vue admin de la liste
        $this->renderView('reservations/list', [
            'reservations' => $reservations
        ], 'index');
    }
}

