<?php
$title = "Results";
require_once '../config/connection.php';

// Fetch the results from the 'results' table and join with the 'candidates' table to get candidate details
$sql = "SELECT candidates.name, results.vote_count 
        FROM results 
        JOIN candidates ON results.candidate_id = candidates.id 
        ORDER BY results.vote_count DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching results: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file here -->
</head>
<body>
    <h1>Election Results</h1>
    <table border="1">
        <tr>
            <th>Candidate Name</th>
            <th>Votes</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['vote_count']) . "</td>";
            echo "</tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
