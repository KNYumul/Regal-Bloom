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
                    <img src="Resources/banner.png" alt="banner" class="banner-img">
                    <img src="Resources/userHomeBanner.png" alt="banner" class="banner-text" width="80%">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid about-section">
        <div class="row">
            <div class="col text-center">
                <h1 class="Snell text-color t6">About Us</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row gap-5 mx-5">

            <div class="col px-0 text-center">
                <p class="text-color TheSeason t4">
                    At Royal Bloom, we believe that true beauty radiates from within, blossoming through confidence, grace, and individuality. 
                    Founded on the principles of empowerment and elegance, Royal Bloom is more than just a pageant; it’s a celebration of strength, self expression, and inner royalty. 
                    <br>
                    <br>
                    Our mission is to provide a platform where individuals from all walks of life can shine, share their stories, and wear their crowns with pride, both literal and symbolic. Through our regal themed competitions, we aim to cultivate not only poise and talent but also leadership, purpose, and authenticity. 
                    <br>
                    <br>
                    Whether you are taking your first step on the pageant stage or continuing your journey to the crown, Royal Bloom is where you grow, glow, and reign.
                </p>
            </div>
            
            <div class="col-4 px-0 ">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%" height="100%" class="">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col px-0 text-center">
                <img src="Resources/shower.png" alt="shower" width="100%">
            </div>

            <div class="col px-0 mt-10">
                <div class="row">
                    <img src="Resources/flowerBorder.png " alt="flowerBorder" width="100%" height="100%">
                </div>
                
                <div class="row text-color t5 TheSeason-BoldItalic">
                    <div class="col text-center">
                        Bloom with Grace
                        <br>
                        Reign with Pride
                    </div>
                </div>
                
                <div class="row">
                    <img src="Resources/flowerBorder.png " alt="flowerBorder" width="100%" height="100%">
                </div>
            </div>

            <div class="col px-0">
                <img src="Resources/shower.png" alt="shower" width="100%" class="mirror">
            </div>
        </div>
    </div>

    <div class="container-fluid gallery my-5 px-4">
        <div class="row">
            <div class="col text-center">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
                <img src="Resources/Placeholder.png" alt="Placeholder" width="100%">
            </div>
        </div>
    </div>

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

