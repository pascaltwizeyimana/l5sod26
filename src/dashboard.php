<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle Add Player
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $team = $_POST['team'];
    $stmt = $pdo->prepare("INSERT INTO players (name, position, team) VALUES (?, ?, ?)");
    $stmt->execute([$name, $position, $team]);
}

// Handle Delete Player
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM players WHERE id = ?");
    $stmt->execute([$id]);
}

// Fetch all players
$players = $pdo->query("SELECT * FROM players")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>🏀 Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?> | <a href="logout.php" class="btn">Logout</a></p>

    <h2>Add Player</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Player Name" required>
        <input type="text" name="position" placeholder="Position" required>
        <input type="text" name="team" placeholder="Team" required>
        <button type="submit" name="add" class="btn">Add</button>
    </form>

    <h2>Players List</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; text-align:left;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Team</th>
            <th>Action</th>
        </tr>
        <?php foreach($players as $player): ?>
        <tr>
            <td><?php echo $player['id']; ?></td>
            <td><?php echo $player['name']; ?></td>
            <td><?php echo $player['position']; ?></td>
            <td><?php echo $player['team']; ?></td>
            <td><a href="?delete=<?php echo $player['id']; ?>" class="btn">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
