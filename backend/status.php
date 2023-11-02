<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .service {
            display: flex;
            align-items: center;
            margin: 10px;
        }

        .service-name {
            flex: 1;
            font-size: 18px;
            margin-left: 10px;
        }

        .status-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .online {
            background-color: #44bd32; /* Green */
        }

        .offline {
            background-color: #e84118; /* Red */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Status Page</h1>

        <div class="service">
            <div class="status-dot" id="status1"></div>
            <div class="service-name">www.netsupport-inc.com</div>
        </div>
        <div class="service">
            <div class="status-dot" id="status2"></div>
            <div class="service-name">www.netsupportschool.com</div>
        </div>
        <div class="service">
            <div class="status-dot" id="status3"></div>
            <div class="service-name">support.netsupportsoftware.com</div>
        </div>
        <div class="service">
            <div class="status-dot" id="status4"></div>
            <div class="service-name">www.contentkeeper.com</div>
        </div>

        <!-- Add more services here following the same pattern -->

        <script>
            function checkStatus(serviceUrl, statusDot) {
                fetch(`https://${serviceUrl}`)
                    .then(response => {
                        if (response.status === 200) {
                            statusDot.classList.remove('offline');
                            statusDot.classList.add('online');
                        } else {
                            statusDot.classList.remove('online');
                            statusDot.classList.add('offline');
                        }
                    })
                    .catch(() => {
                        statusDot.classList.remove('online');
                        statusDot.classList.add('offline');
                    });
            }

            function updateStatus() {
                const services = [
                    { url: "www.netsupport-inc.com", statusId: "status1" },
                    { url: "www.netsupportschool.com", statusId: "status2" },
                    { url: "support.netsupportsoftware.com", statusId: "status3" },
                    { url: "www.contentkeeper.com", statusId: "status4" }
                    // Add more services here
                ];

                services.forEach(service => {
                    const statusDot = document.getElementById(service.statusId);
                    checkStatus(service.url, statusDot);
                });
            }

            // Update the status initially and every 30 seconds (adjust as needed)
            updateStatus();
            setInterval(updateStatus, 30000);
        </script>
    </div>
</body>
</html>
