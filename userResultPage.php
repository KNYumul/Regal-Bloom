<?php
// Database connection
require_once 'dbconnection.php'; 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$criteria = ['overall', 'fashion', 'talent', 'QA', 'advocacy', 'photogenic'];
$results = [];

foreach ($criteria as $crit) {
    // First, get the maximum vote count for this criteria
    $max_votes_sql = "
        SELECT MAX(vote_count) AS max_votes
        FROM (
            SELECT COUNT(*) AS vote_count
            FROM tbl_votes
            WHERE $crit IS NOT NULL AND $crit != ''
            GROUP BY $crit
        ) AS vote_counts
    ";
    
    $max_result = $conn->query($max_votes_sql);
    
    if ($max_result && $max_row = $max_result->fetch_assoc()) {
        $max_votes = $max_row['max_votes'];
        
        // Now get all contestants with the maximum vote count
        $sql = "
            SELECT $crit AS contestant_id, COUNT(*) AS votes
            FROM tbl_votes
            WHERE $crit IS NOT NULL AND $crit != ''
            GROUP BY $crit
            HAVING COUNT(*) = $max_votes
            ORDER BY $crit
        ";
        
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $winners = [];
            $vote_count = 0;
            $contestant_ids = [];
            
            // Collect all winners with their details
            while ($row = $result->fetch_assoc()) {
                $contestant_id = $row['contestant_id'];
                $vote_count = $row['votes'];
                $contestant_ids[] = $contestant_id;
                
                // Get contestant details including name and images
                $details_sql = "SELECT contestant_name, contestant_headshot, contestant_fullbody FROM tbl_contestant WHERE contestant_id = ? LIMIT 1";
                $stmt = $conn->prepare($details_sql);
                $stmt->bind_param("i", $contestant_id);
                $stmt->execute();
                $details_result = $stmt->get_result();
                $details_row = $details_result->fetch_assoc();
                
                if ($details_row) {
                    $winners[] = [
                        'id' => $contestant_id,
                        'name' => $details_row['contestant_name'],
                        'headshot' => $details_row['contestant_headshot'],
                        'fullbody' => $details_row['contestant_fullbody']
                    ];
                } else {
                    $winners[] = [
                        'id' => $contestant_id,
                        'name' => 'Unknown',
                        'headshot' => '',
                        'fullbody' => ''
                    ];
                }
            }
            
            $results[$crit] = [
                'winners' => $winners,
                'votes' => $vote_count,
                'has_data' => true
            ];
        } else {
            $results[$crit] = ['has_data' => false];
        }
    } else {
        $results[$crit] = ['has_data' => false];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest Results</title>
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
                    <button type="button" class="btn btn-danger mx-3">Signout</button>
                </form>
            </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col px-0">
            <div class="banner-crop">
                <img src="Resources/banner2.png" alt="banner" class="banner-img">
                <img src="Resources/userResultBanner.png" alt="banner" class="banner-text" width="80%">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-5">
    <?php 
    $category_titles = [
        'overall' => 'Overall Personality & Presence',
        'fashion' => 'Fashion Segment',
        'talent' => 'Talent Segment',
        'QA' => 'Q&A Segment',
        'advocacy' => 'Advocacy Platform',
        'photogenic' => 'Photogenic Qualities'
    ];
    
    foreach ($criteria as $crit): ?>
        <div class="category-section">
                <h2 class="Snell text-color mb-0 t5"><?php echo $category_titles[$crit]; ?></h2>
            
            <?php if ($results[$crit]['has_data']): ?>
                <div class="row">
                    <div class="col">
                        <h4 class="text-center mb-4 text-color">
                            Winner<?php echo count($results[$crit]['winners']) > 1 ? 's' : ''; ?> 
                            (<?php echo $results[$crit]['votes']; ?> votes)
                        </h4>
                        
                        <?php foreach ($results[$crit]['winners'] as $winner): ?>
                            <div class="winner-card">
                                <div class="winner-image-container">
                                    <?php if (!empty($winner['headshot'])): ?>
                                        <img src="<?php echo htmlspecialchars($winner['headshot']); ?>" 
                                             alt="<?php echo htmlspecialchars($winner['name']); ?>" 
                                             class="winner-image">
                                    <?php else: ?>
                                        <div class="winner-image bg-secondary d-flex align-items-center justify-content-center">
                                            <span class="text-white">No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="winner-info">
                                    <h5 class="mb-1"><?php echo htmlspecialchars($winner['name']); ?></h5>
                                    <p class="mb-0 text-muted">Contestant #<?php echo $winner['id']; ?></p>
                                    <p class="mb-0"><strong><?php echo $results[$crit]['votes']; ?> votes</strong></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <h5>No votes recorded for this category yet</h5>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
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
    </div>
</footer>   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>