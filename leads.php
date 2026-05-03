<?php
session_start();
include "db.php";

if (!isset($_SESSION['auth'])) {
    die("⛔ Access denied");
}
/* =========================
   🌍 LANGUAGE SWITCH
========================= */

$lang = $_GET['lang'] ?? 'en';

$T = [
    'en' => [
        'title' => 'Leads CRM',
        'logout' => 'Logout',
        'search' => 'Search',
        'name' => 'Name',
        'email' => 'Email',
        'message' => 'Message',
        'date' => 'Date',
        'actions' => 'Actions',
        'edit' => 'Edit',
        'delete' => 'Delete',
    ],
    'de' => [
        'title' => 'Leads CRM',
        'logout' => 'Abmelden',
        'search' => 'Suche',
        'name' => 'Name',
        'email' => 'E-Mail',
        'message' => 'Nachricht',
        'date' => 'Datum',
        'actions' => 'Aktionen',
        'edit' => 'Bearbeiten',
        'delete' => 'Löschen',
    ]
];

$t = $T[$lang];

/* =========================
   🔃 SORTING
========================= */

$sort = $_GET['sort'] ?? 'new';

if ($sort == 'old') {
    $order = "ASC";
} elseif ($sort == 'name') {
    $order = "name ASC";
} else {
    $order = "DESC";
}

/* =========================
   🔎 SEARCH
========================= */

$search = $_GET['search'] ?? '';

/* =========================
   📄 PAGINATION
========================= */

$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

if ($search) {
    $stmt = $conn->prepare("
        SELECT * FROM leads 
        WHERE name LIKE ? OR email LIKE ?
        ORDER BY created_at $order
        LIMIT ? OFFSET ?
    ");

    $like = "%$search%";
    $stmt->bind_param("ssii", $like, $like, $limit, $offset);
    $stmt->execute();

    $result = $stmt->get_result();

} else {
    $result = $conn->query("
        SELECT * FROM leads 
        ORDER BY created_at $order
        LIMIT $limit OFFSET $offset
    ");
}

/* COUNT pages */
$count = $conn->query("SELECT COUNT(*) as total FROM leads")->fetch_assoc();
$pages = ceil($count['total'] / $limit);
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<title><?= $t['title'] ?></title>

<style>
body { font-family: Arial; background:#f4f6f8; padding:20px; }

table { width:100%; border-collapse:collapse; background:white; }
th, td { padding:10px; border-bottom:1px solid #ddd; }

th { background:#222; color:white; }

a.btn {
    padding:5px 10px;
    text-decoration:none;
    color:white;
    border-radius:4px;
}

.edit { background:#3498db; }
.delete { background:#e74c3c; }

.topbar {
    margin-bottom:15px;
}
</style>
</head>

<body>

<h2><?= $t['title'] ?></h2>

<div class="topbar">

<!-- 🌍 LANGUAGE -->
<a href="?lang=en">EN</a> | 
<a href="?lang=de">DE</a>

<br><br>

<!-- 🔎 SEARCH -->
<form method="GET">
    <input type="hidden" name="lang" value="<?= $lang ?>">
    <input type="text" name="search" placeholder="<?= $t['search'] ?>">
    <button>OK</button>
</form>

<br>

<!-- 🔃 SORT -->
Sort:
<a href="?sort=new&lang=<?= $lang ?>">Newest</a> |
<a href="?sort=old&lang=<?= $lang ?>">Oldest</a> |
<a href="?sort=name&lang=<?= $lang ?>">Name</a>

<br><br>

<a href="logout.php"><?= $t['logout'] ?></a>

</div>

<table>
<tr>
    <th>ID</th>
    <th><?= $t['name'] ?></th>
    <th><?= $t['email'] ?></th>
    <th><?= $t['message'] ?></th>
    <th><?= $t['date'] ?></th>
    <th><?= $t['actions'] ?></th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['message']) ?></td>
    <td><?= $row['created_at'] ?></td>
    <td>       
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
        <?php else: ?>
            <span>Read-only</span>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>

</table>

<br>

<!-- 📄 PAGINATION -->
<div>
<?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?page=<?= $i ?>&lang=<?= $lang ?>&sort=<?= $sort ?>">
        [<?= $i ?>]
    </a>
<?php endfor; ?>
</div>

</body>
</html>