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
                    <img src="Resources/banner3.png" alt="banner" class="banner-img" id="categoriesBanner-position">
                    <img src="Resources/userCategoriesBanner.png" alt="banner" class="banner-text" width="80%">
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <img src="Resources/showerBorder.png" alt="Border" style="width: 100%; height: auto; margin-top: -3.5cm;">
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <h1 class="TheSeason text-color t4">
                Each and every category celebrates style, grace, and self expression. From<br>
                casual flair to cultural elegance and evening sophistication, each segment<br> 
                showcases the contestant’s confidence, creativity, and presence on stage.
            </h1>
        </div>
    </div>

    <div class="row mx-5 my-5">
        <div class="col">
            <img src="Resources/c-casual.png" class="img-fluid" style="width: 20cm; height: auto;">
        </div>
        <div class="col text-center text-color align-self-center">
            <h1 class="Snell t2 ">Casual / Fashion Wear</h1>
            <p class="TheSeason t8 ">
                A showcase of everyday style with confidence.
                Contestants express their personality through
                trendy, creative, ir modern casual looks.
            </p>
            <a class="nav-link underlineAnimation py-0 mx-3 TheSeason-Italic" href="c-casual.php">View More</a>
        </div>
    </div>

    <div class="row mx-5 my-5">
        <div class="col text-center text-color align-self-center">
            <h1 class="Snell t3">Swimwear / Fitness Wear</h1>
            <p class="TheSeason t8 mb-2">
                This segment highlights fitness, confidence, 
                and stage presence. Contestants are judged 
                on posture, poise, and how they carry themselves.
            </p>
            <a class="nav-link underlineAnimation py-0 mx-3 TheSeason-Italic" href="c-swimwear.php">View More</a>
        </div>
        <div class="col">
            <img src="Resources/c-swimwear.png" class="img-fluid">
        </div>
    </div>

    <div class="row mx-5 my-5">
        <div class="col">
            <img src="Resources/c-traditional.png" class="img-fluid">
        </div>
        <div class="col text-center text-color align-self-center">
            <h1 class="Snell t2">Traditional Wear</h1>
            <p class="TheSeason t8 mb-2">
                A tribute to cultural roots and heritage. 
                Contestants wear attire that reflects their identity, 
                traditions, or origin with elegance and pride.
            </p>
            <a class="nav-link underlineAnimation py-0 mx-3 TheSeason-Italic" href="c-traditional.php">View More</a>
        </div>
    </div>

    <div class="row mx-5 my-5">
        <div class="col text-center text-color align-self-center">
            <h1 class="Snell t7">Evening Gown / Formal Wear</h1>
            <p class="TheSeason t8 mb-2">
                The pinnacle of elegance and grace. Contestants dazzle 
                in sophisticated formal wear, 
                judged on poise, presentation, and overall impact.

            </p>
            <a class="nav-link underlineAnimation py-0 mx-3 TheSeason-Italic" href="c-evening.php">View More</a>
        </div>
        <div class="col">
            <img src="Resources/c-evening.png" class="img-fluid">
        </div>
    </div>


<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <img src="Resources\logoNoName.png" alt="Logo" width="160" class="d-inline-block align-text-center ms-2">
                <h1 class="Snell text-center text-color ms-4 mb-2">Regal Bloom</h1>
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