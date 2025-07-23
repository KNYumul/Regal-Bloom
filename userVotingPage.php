<?php

session_start();

require_once "dbconnection.php";

if ($conn -> connect_error) {
    ?>
    <script>
        console.log ("Connection failed");
    </script>
    <?php
} else {
    ?>
    <script>
        console.log ("Connection Successful"); 
    </script>
    <?php
}

if(isset($_POST['sub'])) {

    // Get judge info from session
    $voter_id = $_SESSION['judge_id'];
    $voter_name = $_SESSION['judge_name'];

    $overall = $_POST['overall'];
    $fashion = $_POST['fashion'];
    $talent = $_POST['talent'];
    $qa = $_POST['Q&A'];
    $advocacy = $_POST['advocacy'];
    $photogenic = $_POST['photogenic'];

    $insertsql = "INSERT INTO tbl_votes (voter_id, voter_name, overall, fashion, talent, QA, advocacy, photogenic) 
    VALUES ('$voter_id', '$voter_name', '$overall', '$fashion', '$talent', '$qa', '$advocacy', '$photogenic')";

    try {
        $result = $conn->query($insertsql);

        if ($result == TRUE ) {
            header("Location: userHomePage.php");
            ?>
            <script>
                alert("Voting Successful");
            </script>
            <?php
            exit;
        } else {
            ?>
            <script>
                alert("Voting Failed");
            </script>
            <?php
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            ?>
            <script>
                alert("You have already voted.");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Voting Failed: <?php echo $e->getMessage(); ?>");
            </script>
            <?php
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="userHomePageBg">

<nav class="navbar sticky-top bg-transparent shadow" >
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex align-items-center">
                <a href="userHomePage.php">
                <img src="Resources\logo.png" alt="Logo" width="100" class="d-inline-block align-text-center">
                </a>

                <a class="Snell t5 ms-3" href="userHomePage.php">
                Regal Bloom
                </a>

            </div>
        </div>
        

        <ul class="nav justify-content-end">    
                <li class="nav-item">
                    <a class="nav-link underlineAnimation py-0 mx-3" aria-current="page" href="userHomePage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link underlineAnimation py-0 mx-3" href="userCandidatesPage.php">Candidates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link underlineAnimation py-0 mx-3" href="userCategoriesPage.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link underlineAnimation py-0 mx-3" href="userVotingPage.php">Voting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link underlineAnimation py-0 mx-3" href="userResultPage.php">Results</a>
                </li>
                <form action="logout.php" method="post">
                    <button type="button "class="btn btn-danger mx-3">Signout</button>
                </form>
            </ul>
    </div>

</nav>

<div class="container-fluid">
        <div class=" row">
            <div class="col px-0">
                <div class="banner-crop">
                    <img src="Resources/banner4.png" alt="banner" class="banner-img" id="votingBanner-position">
                    <img src="Resources/userVotingBanner.png" alt="banner" class="banner-text" width="80%">
                </div>
            </div>
        </div>
</div>

<div class="row mb-5" style="margin-top: -1cm;">
    <div class="col text-center">
        <h1 class="Snell t6 text-color">Vote Now!</h1>
        <p class="TheSeason-Bold t4 text-color">Your vote matters. You can Only vote 1 candidate per Category.</p>
    </div>
</div>

<form action="userVotingPage.php" method="POST">
    
<!-- Overall Personality & Presence -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Overall Personality & Presence</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="overall" id="overall1" value="1" class="candidate-radio" required>
        <label for="overall1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="overall" id="overall2" value="2" class="candidate-radio">
        <label for="overall2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="overall" id="overall3" value="3" class="candidate-radio">
        <label for="overall3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="overall" id="overall4" value="4" class="candidate-radio">
        <label for="overall4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="overall" id="overall5" value="5" class="candidate-radio">
        <label for="overall5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<!-- Fashion Segment -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Fashion Segment</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="fashion" id="fashion1" value="1" class="candidate-radio" required>
        <label for="fashion1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="fashion" id="fashion2" value="2" class="candidate-radio">
        <label for="fashion2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="fashion" id="fashion3" value="3" class="candidate-radio">
        <label for="fashion3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="fashion" id="fashion4" value="4" class="candidate-radio">
        <label for="fashion4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="fashion" id="fashion5" value="5" class="candidate-radio">
        <label for="fashion5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<!-- Talent Segment -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Talent Segment</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="talent" id="talent1" value="1" class="candidate-radio" required>
        <label for="talent1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="talent" id="talent2" value="2" class="candidate-radio">
        <label for="talent2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="talent" id="talent3" value="3" class="candidate-radio">
        <label for="talent3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="talent" id="talent4" value="4" class="candidate-radio">
        <label for="talent4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="talent" id="talent5" value="5" class="candidate-radio">
        <label for="talent5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<!-- Q&A Segment -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Q&A Segment</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="Q&A" id="Q&A1" value="1" class="candidate-radio" required>
        <label for="Q&A1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="Q&A" id="Q&A2" value="2" class="candidate-radio">
        <label for="Q&A2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="Q&A" id="Q&A3" value="3" class="candidate-radio">
        <label for="Q&A3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="Q&A" id="Q&A4" value="4" class="candidate-radio">
        <label for="Q&A4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="Q&A" id="Q&A5" value="5" class="candidate-radio">
        <label for="Q&A5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<!-- Advocacy Platform -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Advocacy Platform</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="advocacy" id="advocacy1" value="1" class="candidate-radio" required>
        <label for="advocacy1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="advocacy" id="advocacy2" value="2" class="candidate-radio">
        <label for="advocacy2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="advocacy" id="advocacy3" value="3" class="candidate-radio">
        <label for="advocacy3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="advocacy" id="advocacy4" value="4" class="candidate-radio">
        <label for="advocacy4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="advocacy" id="advocacy5" value="5" class="candidate-radio">
        <label for="advocacy5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<!-- Photogenic Qualities  -->
<div class="row mx-5">
    <div class="col">
        <h1 class="Snell t5 text-color">Photogenic Qualities</h1>
    </div>
</div>
<div class="row mx-5 mb-4">
    <div class="col">
        <input type="radio" name="photogenic" id="photogenic1" value="1" class="candidate-radio" required>
        <label for="photogenic1" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 1" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 1</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="photogenic" id="photogenic2" value="2" class="candidate-radio">
        <label for="photogenic2" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 2" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 2</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="photogenic" id="photogenic3" value="3" class="candidate-radio">
        <label for="photogenic3" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 3" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 3</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="photogenic" id="photogenic4" value="4" class="candidate-radio">
        <label for="photogenic4" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 4" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 4</p>
        </label>
    </div>
    <div class="col">
        <input type="radio" name="photogenic" id="photogenic5" value="5" class="candidate-radio">
        <label for="photogenic5" class="candidate-label">
            <img src="Resources/Placeholder.png" alt="Candidate 5" class="img-fluid mb-2">
            <p class="text-center text-color">Candidate 5</p>
        </label>
    </div>
</div>

<div class="row">
    <div class="col text-center">
        <button type="submit" class="btn voteButton text-color mb-5" name="sub" id="sub">Submit Vote</button>
    </div>
</div>

</form>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <img src="Resources\logoNoName.png" alt="Logo" width="160" class="d-inline-block align-text-center ms-2">
                <h1 class="Snell text-center text-color ms-4 mb-3">Regal Bloom</h1>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col text-center">
                <a href="https://www.facebook.com" target="_blank"><img src="Resources\facebookLogo.png" alt="Logo" width="40" class="d-inline-block align-text-center mx-2"></a>
                <a href="https://www.instagram.com" target="_blank"><img src="Resources\instagramLogo.png" alt="Logo" width="40" class="d-inline-block align-text-center mx-2"></a>
                <a href="https://www.tiktok.com" target="_blank"><img src="Resources\tiktokLogo.png" alt="Logo" width="40" class="d-inline-block align-text-center mx-2"></a>
            </div>
        </div>
        
        <div class="row">
            <div class="col text-center">
                <p class="text-center text-color">© 2025. ALL RIGHTS RESERVED</p>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <p class="text-center">TERMS & CONDITIONS | PRIVACY POLICY</p>
            </div>
        </div>
</footer>   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
