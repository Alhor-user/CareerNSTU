<?php 
    $ratioWidth = 300;
    $ratioHeight = 400; 
?>

<div style="margin-top: 70px;">
    <div class="uk-card uk-card-default" style="width: <?php echo $ratioWidth; ?>">
        <div style="height: 52px">
            <?php
            if (self::$companyData["IsIT"] != "0") {
                echo '<span class="uk-label uk-label-danger" style="margin: 0 0 10px 10px;" >IT</span>';
            }
            if (self::$companyData["IsInternship"] != "0") {
                echo '<span class="uk-label uk-label-warning" style="margin: 0 0 10px 10px;" >Стажировка</span>';
            }
            if (self::$companyData["IsVacancy"] != "0") {
                echo '<span class="uk-label uk-label-success" style="margin: 0 0 10px 10px;" >Работа</span>';
            }

            if (self::$companyData["IsFrontend"] != "0") {
                echo '<span class="uk-label uk-label" style="margin: 0 0 10px 10px;" >Frontend</span>';
            }
            if (self::$companyData["IsBackend"] != "0") {
                echo '<span class="uk-label uk-label" style="margin: 0 0 10px 10px;" >Backend</span>';
            }
            if (self::$companyData["IsDevOps"] != "0") {
                echo '<span class="uk-label uk-label" style="margin: 0 0 10px 10px;" >DevOps</span>';
            }
            if (self::$companyData["IsQA"] != "0") {
                echo '<span class="uk-label uk-label" style="margin: 0 0 10px 10px;" >QA</span>';
            }
            if (self::$companyData["IsMobile"] != "0") {
                echo '<span class="uk-label uk-label" style="margin: 0 0 10px 10px;" >Mobile</span>';
            }
            ?>    
        </div>
    
        <a href="<?php echo self::$companyData["Site"]; ?>" target="_blank"><h2 class="uk-card-title uk-text-center uk-text-bolder" style="margin: 10px 0 20px 0;"><?php echo self::$companyData["Name"]; ?></h3></a>
        <div class="uk-card-media-top">
            <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: <?php echo $ratioWidth, ":", $ratioHeight; ?>; animation: slide">
                <ul class="uk-slideshow-items" uk-lightbox="animation: slide">
  
                <?php 
                if (count(self::$companyData["ImgName"]) == 0) {
                    echo '<img src="../img/noimage.png" alt="">';
                }

                for ($counter = 0; $counter < count(self::$companyData["ImgName"]); $counter++):
                    $filenamePart = self::$companyData["ImgName"][$counter];
                    $filename = "img/$filenamePart";

                    $test = calculate($filename, $ratioWidth, $ratioHeight);
                ?>
                    <li>
                        <a class="uk-inline uk-align-center" href="../img/<?php echo self::$companyData["ImgName"][$counter]; ?>" data-caption="<?php echo $counter+1; ?>">
                            <img <?php if ($test[1]=="l") echo "style=\"height: ".$ratioHeight."px; margin-left:$test[0]px\""; elseif ($test[1]=="t") echo "style=\"width:100%; margin-top:$test[0]px\""; ?> data-src="../img/<?php echo self::$companyData["ImgName"][$counter]; ?>" alt="" uk-img="target: !.uk-slideshow-items">
                        </a>
                    </li>
                <?php endfor; ?>
            
                </ul>
                <div class="uk-position-bottom-center uk-position-small">
                    <ul class="uk-dotnav">

                <?php 
                for ($counter = 0; $counter < count(self::$companyData["ImgName"]); $counter++) {
                    echo "<li uk-slideshow-item=\"$counter\"><a href=\"#\">Item $counter</a></li>";
                } ?>

                    </ul>
                </div>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            </div>
        </div>
        <div class="uk-card-body">
            <p><?php 
            // $description = self::$companyData["Description"]; 
            // $description = str_replace("@", "<li>", $description);
            // $description = str_replace("!@", "</li>", $description);
            // $description = "<ul class=\"uk-list uk-list-divider\">" . $description . "</ul>";
            // echo $description;
            ?></p>
        </div>
    </div>
</div>