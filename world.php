
<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? 'countries';

// Check whether the user requested cities
if ($lookup === 'cities') {

    $sql = "SELECT cities.name, cities.district, cities.population
            FROM cities
            JOIN countries ON cities.country_code = countries.code
            WHERE countries.name LIKE :country";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        'country' => '%' . $country . '%'
    ]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['district']); ?></td>
                    <td><?= htmlspecialchars((string)$row['population']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php
} else {

    // Retrieve country information
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

<?php
}
?>