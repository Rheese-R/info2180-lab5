
<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';

$sql = "SELECT * FROM countries WHERE name LIKE :country";
$stmt = $conn->prepare($sql);

$stmt->execute([
    'country' => '%' . $country . '%'
]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <thead>
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['continent']); ?></td>
                <td><?= htmlspecialchars((string)($row['independence_year'] ?? 'N/A')); ?></td>
                <td><?= htmlspecialchars($row['head_of_state'] ?? 'Unknown'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
