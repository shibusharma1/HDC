<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Voting Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .info p {
            margin: 10px 0;
        }

        .voting-results {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>School Voting Dashboard</h1>
        <div class="info">
            <p>Current Time: <span id="currentTime"></span></p>
            <p>Voting Start Time: <span id="startTime"></span></p>
            <p>Voting End Time: <span id="endTime"></span></p>
        </div>
        <div class="voting-results">
            <h2>Real-Time Voting Results</h2>
            <div id="results"></div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateTime() {
                const now = new Date();
                document.getElementById("currentTime").textContent = now.toLocaleTimeString();
            }

            function fetchVotingInfo() {
                fetch('server.php')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("startTime").textContent = data.start_time;
                        document.getElementById("endTime").textContent = data.end_time;
                        updateResults(data.votes);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            function updateResults(votes) {
                const resultsContainer = document.getElementById("results");
                resultsContainer.innerHTML = "";
                for (const [candidate, count] of Object.entries(votes)) {
                    const candidateElement = document.createElement("p");
                    candidateElement.textContent = `${candidate}: ${count} votes`;
                    resultsContainer.appendChild(candidateElement);
                }
            }

            updateTime();
            setInterval(updateTime, 1000); // Update current time every second
            setInterval(fetchVotingInfo, 5000); // Fetch voting info every 5 seconds
            fetchVotingInfo();
        });

    </script>
</body>

</html>