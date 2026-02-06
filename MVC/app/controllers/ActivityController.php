<?php
require_once './app/utils/Render.php';

class ActivityController
{
    // ajout du trait Render pour gerer l'affichage des vues
    use Render;

    // page la liste des activitees
    public function index(): void
    {
        session_start();
        $activiteModel = new ActiviteModel(); // instancie le modele des activitees
        $activities = $activiteModel->getAllActivities(); // reupere toutes les activitees
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

        // affiche la vue dans activities/index.php  avec les données
        $this->renderView('activities/index', [
            'activities' => $activities,
            'isAdmin' => $isAdmin
        ], 'index');
    }


    // page detail d'une activitées
    public function show(int $id): void
    {
        session_start();
        $activiteModel = new ActiviteModel();
        $activity = $activiteModel->getActivityById($id);

        if (empty($activity)) {
            header("Location: /");
            exit;
        }

          // nombre de places restantes
        $placesLeft = $activiteModel->getPlacesLeft($id);
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
        $isLoggedIn = isset($_SESSION['id']);


        // affiche la vue show
        $this->renderView('activities/show', [
            'activity' => $activity,
            'placesLeft' => $placesLeft,
            'isAdmin' => $isAdmin,
            'isLoggedIn' => $isLoggedIn
        ], 'index');
    }


     // page modification d'une activitees
    public function update(int $id): void
    {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $activiteModel = new ActiviteModel();
        $activity = $activiteModel->getActivityById($id);

        // si l'activitee n'existe pas
        if (empty($activity)) {
            header("Location: /");
            exit;
        }

        if ($_POST) {
            $co = $activiteModel->getCo(); // connexion PDO
            $stmt = $co->prepare('UPDATE activities SET nom = :nom, type_id = :type_id, places_disponibles = :places_disponibles, description = :description, datetime_debut = :datetime_debut, duree = :duree WHERE id = :id');
            $success = $stmt->execute([             // execute la requete de mise a jour
                'id' => $id,
                'nom' => $_POST['nom'],
                'type_id' => $_POST['type_id'],
                'places_disponibles' => $_POST['places_disponibles'],
                'description' => $_POST['description'],
                'datetime_debut' => $_POST['datetime_debut'],
                'duree' => $_POST['duree']
            ]);

            if ($success) {
                header("Location: /activity/show/$id");
                exit;
            }
        }

        $co = $activiteModel->getCo();
        $stmt = $co->prepare('SELECT * FROM type_activite');
        $stmt->execute();
        $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->renderView('activities/update', [
            'activity' => $activity,
            'types' => $types
        ], 'index');
    }

      // suppresion d'une activitée
    public function delete(int $id): void 
    {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $activiteModel = new ActiviteModel();
        $reservationModel = new ReservationModel();

        // supprime d’abord les reservations liees (sinon erreur FK)
        $co = $reservationModel->getCo();
        $stmt = $co->prepare('DELETE FROM reservations WHERE activite_id = :id');
        $stmt->execute(['id' => $id]);

        // supprime ensuite l’activites
        $co = $activiteModel->getCo();
        $stmt = $co->prepare('DELETE FROM activities WHERE id = :id');
        $stmt->execute(['id' => $id]);

        header("Location: /");
        exit;
    }

     // création d'une activité
    public function create(): void
    {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit;
        }

        if ($_POST) {
            $activiteModel = new ActiviteModel();
            $co = $activiteModel->getCo();
            $stmt = $co->prepare('INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree) VALUES (:nom, :type_id, :places_disponibles, :description, :datetime_debut, :duree)');
            $success = $stmt->execute([
                'nom' => $_POST['nom'],
                'type_id' => $_POST['type_id'],
                'places_disponibles' => $_POST['places_disponibles'],
                'description' => $_POST['description'],
                'datetime_debut' => $_POST['datetime_debut'],
                'duree' => $_POST['duree']
            ]);

            if ($success) {
                header("Location: /");
                exit;
            }
        }
         // recupere liste des types (pour le formulaire)
        $activiteModel = new ActiviteModel();
        $co = $activiteModel->getCo();
        $stmt = $co->prepare('SELECT * FROM type_activite');
        $stmt->execute();
        $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // affiche la vue create
        $this->renderView('activities/create', [
            'types' => $types
        ], 'index');
    }
}

