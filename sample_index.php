<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <title>HOME</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: hsl(186.72deg 93.8% 35.43%);
        }
        
        .header {
            background-color: #ffcc00;
            color: white;
            padding: 1px;
            text-align: center;
        }
        
        .image-container {
            display: flex;
            justify-content: center;
        }
        
        .image-container img {
            width: auto;
            max-width: 100%;
            margin: 0 20px;
        }
        
        .section {
            padding: 20px;
        }
        
        .vision-mission {
            max-width: 100%;
        }
        
        .button-container {
            text-align: center;
            max-width: 80%;
            margin: 0 auto;
        }
        
        .button-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
        }
        .nav-link {
    margin-right: 40px; /* Adjust as needed */
}

    </style>
</head>
<body>

<div class="header">
    <div class="image-container">
        <img src="banner.jpg" alt="Description">
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="important_dates.php">IMPORTANT DATES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="section">
        <div class="vision-mission">
            <h2>Vision</h2>
            <p>To evolve as center of repute for providing quality academic programs amalgamated with creative learning and research excellence to produce graduates with leadership qualities, ethical and human values to serve the nation.
                To produce highly competent professional leaders for contributing to Socio-economic development of region and the nation.</p>

            <h2>Mission</h2>
            <p>M1:To provide high quality education with enriched curriculum blended with impactful teaching-learning practices.

                M2:To promote research, entrepreneurship and innovation through industry collaborations.

                M3:To produce highly competent professional leaders for contributing to Socio-economic development of region and the nation.
                To produce highly competent professional leaders for contributing to Socio-economic development of region and the nation.</p>
        </div>

        <div class="button-container">
            <button onclick="window.location.href='form.php'">Registration Form</button>
            <button onclick="window.location.href='print_application_form.html'">Print Application</button>
            <button onclick="window.location.href='down_sample.html'">Download Hall Ticket</button>
            <button type="button" class="btn btn-success">Success</button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
