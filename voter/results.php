<?php
require_once '../config/connection.php';

$sql = "
SELECT c.Name, COUNT(v.vote_id) as vote_count
FROM votes v
JOIN candidates c ON v.crn = c.CRN
GROUP BY v.crn
ORDER BY vote_count DESC
LIMIT 1
";

$result = mysqli_query($conn, $sql);

if ($result) {
    $winner = mysqli_fetch_assoc($result);
    echo "The winner is " . htmlspecialchars($winner['Name']) . " with " . $winner['vote_count'] . " votes.";
} else {
    echo "Error retrieving result: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<?php
include_once 'footer.php';
?>