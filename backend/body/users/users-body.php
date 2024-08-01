<main class="container-fluid">
  <?php
  if (isset($_SESSION['error_msg'])) {
      echo '<div class="text-center text-warning">
        <h2>' . $_SESSION['error_msg'] . '</h2></div>';
  } elseif (isset($_SESSION['success_msg'])) {
      echo '<div class="text-center text-success">
        <h2>' . $_SESSION['success_msg'] . '</h2></div>';
  }
  ?>
  <div class="row">
    <h2>Benutzerverwaltung</h2>
    <table class="table table-dark table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Profilbild</th>
          <th scope="col">Vorname</th>
          <th scope="col">Nachname</th>
          <th scope="col">E-Mail</th>
          <th scope="col">Bestätigt</th>
          <th scope="col">Admin</th>
          <th scope="col">Aktionen</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $mysqli->query("SELECT id, prename, surname, email, is_confirmed, is_admin, profilpicture FROM users");
        while ($row = $result->fetch_assoc()) {
            $userId = $row['id'];
            $profilPicturePath = "/pictures/profil/{$userId}/" . $row['profilpicture'];
            $profilPictureUrl = file_exists($_SERVER['DOCUMENT_ROOT'] . $profilPicturePath) ? $profilPicturePath : "/pictures/profil/default.png";

            echo "<tr>";
            echo "<td>{$userId}</td>";
            echo "<td><img src='{$profilPictureUrl}' alt='Profilbild' style='width: 100px; height: 100px;'></td>";
            echo "<form action='/apps/connection/users/user_update.php' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='{$userId}'>";
            echo "<td><input type='text' class='form-control' name='prename' value='{$row['prename']}' required></td>";
            echo "<td><input type='text' class='form-control' name='surname' value='{$row['surname']}' required></td>";
            echo "<td><input type='email' class='form-control' name='email' value='{$row['email']}' required></td>";
            echo "<td><input class='form-check-input' type='checkbox' name='is_confirmed' " . ($row['is_confirmed'] ? 'checked' : '') . "></td>";
            echo "<td><input class='form-check-input' type='checkbox' name='is_admin' " . ($row['is_admin'] ? 'checked' : '') . "></td>";
            echo "<td>
                      <input type='file' class='form-control' name='profilpicture'>
                      <button class='btn btn-outline-primary mt-2' type='submit' name='update_user'>Aktualisieren</button>
                      <button class='btn btn-outline-danger mt-2' type='submit' name='delete_user'>Löschen</button>
                  </td>";
            echo "</form>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <h2>Neuen Benutzer hinzufügen</h2>
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">Vorname</th>
        <th scope="col">Nachname</th>
        <th scope="col">E-Mail</th>
        <th scope="col">Passwort</th>
        <th scope="col">Profilbild</th>
        <th scope="col">Bestätigt</th>
        <th scope="col">Admin</th>
        <th scope="col">Aktionen</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <form action="/app/connection/users/user_update.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="add_user" value="1">
          <td><input type="text" class="form-control" name="prename" required></td>
          <td><input type="text" class="form-control" name="surname" required></td>
          <td><input type="email" class="form-control" name="email" required></td>
          <td><input type="password" class="form-control" name="password" required></td>
          <td><input type="file" class="form-control" name="profilpicture" accept="image/*"></td>
          <td><input class="form-check-input" type="checkbox" name="is_confirmed"></td>
          <td><input class="form-check-input" type="checkbox" name="is_admin"></td>
          <td><button type="submit" class="btn btn-primary">Hinzufügen</button></td>
        </form>
      </tr>
    </tbody>
  </table>
  </div>
</main>
