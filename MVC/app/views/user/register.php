<?php

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $user->setPrenom($_POST['username']);
    $user->setNom($_POST['nom']);
    $user->setEmail($_POST['email']);
    $user->setRole($_POST['role']);
    $user->setPwd(password_hash($_POST['password'], PASSWORD_DEFAULT));
    

    $userModel = new UserModel();
    $userModel->add($user);
   }
?>

<footer>
    <h1>Register</h1>
    <form action="" method="POST">
        <input type="text" placeholder="Username" name="username" required>
        <input type="text" placeholder="Nom" name="nom" required>
        <input type="email" placeholder="Email" name="email" required>
        <select placeholder="role" name="role" required>
            <option value="utilisateur">Utilisateur</option>
            <option value="administrateur">Administrateur</option>
            <option value="moderateur">Modérateur</option>
        </select>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit">Sumbit</button>
    </form>
 </footer>
