<title>AniMatch <?php echo $title?></title>


<header>

    <h1 id="header-title">AniMatch</h1>
    <img class="header-img" src=
    <?php
        if ($title == "HOME") {
            echo("\"images/Edward_Elric.png\"/>");
            $source = "https://characterprofile.fandom.com/wiki/Edward_Elric";
            // Image Source: https://characterprofile.fandom.com/wiki/Edward_Elric

        } elseif ($title == "SEARCH") {
            echo("\"images/Yukine.png\"/>");
            $source = "http://img13.deviantart.net/3366/i/2014/053/9/7/yukine___render_2_by_gundi16-d7667rq.png";
            // Image Source: http://img13.deviantart.net/3366/i/2014/053/9/7/yukine___render_2_by_gundi16-d7667rq.png

        } elseif ($title == "FULL LIST") {
            echo("\"images/Nagisa.png\"/>");
            $source = "https://www.deviantart.com/fluffylavandelclouds/art/Render-Free-Nagisa-1-438180506";
            // Image Source: https://www.deviantart.com/fluffylavandelclouds/art/Render-Free-Nagisa-1-438180506

        } else {
            echo("\"images/Meliodas.png\"/>");
            $source = "https://tvtropes.org/pmwiki/pmwiki.php/Characters/TheSevenDeadlySinsMeliodas";
            // Image Source: https://tvtropes.org/pmwiki/pmwiki.php/Characters/TheSevenDeadlySinsMeliodas
        }
    ?>


    <div class="header-rightbox">

    <?php if ($title=="HOME") { ?>
        <h2>Find the right anime for you!</h2>
    <?php } else { ?>
    <!-- Navigation bar code based on Lab 3 -->
        <nav>
            <ul>
                <?php
                    $home = ["HOME","index.php"];
                    $search = ["SEARCH","search.php"];
                    $list = ["FULL LIST","list.php"];
                    $add = ["ADD ANIME","add.php"];

                    $pages = [$home,$search,$list,$add];

                    foreach ($pages as $page) {
                        if ($title==$page[0]) continue;
                        echo "<li><a href=\"" . $page[1] . "\">$page[0]</a></li>";
                    }
                ?>
            </ul>
        </nav>
    <?php } ?>
    </div>

</header>
