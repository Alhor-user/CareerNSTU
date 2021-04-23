<div class="uk-grid uk-grid-match" style="margin-bottom: 40px; justify-content: center;" uk-grid>

<?php
Class companyCard 
{
    static private $companyData;
    static private $cardOutputBuffer;

    function __construct (string $companyID, object $linkToDB) 
    {
        $sql = "SELECT * FROM NSTU_company_list WHERE ID = \"$companyID\"";
        $result = mysqli_query($linkToDB, $sql);
        $dataArray = mysqli_fetch_array($result);

        $sql = "SELECT `ImgName` FROM `NSTU_company_img` JOIN `NSTU_company_list` ON `CompanyID` = NSTU_company_list.ID WHERE CompanyID = \"$companyID\"";
        $result = mysqli_query($linkToDB, $sql);
        $dataArray['ImgName'] = mysqli_fetch_all($result);

        if (count($dataArray['ImgName']) != 0) {
            for ($counter = 0; $counter < count($dataArray['ImgName']); $counter++) {
                $tempArr[$counter] = $dataArray['ImgName'][$counter][0];
            }
            $dataArray['ImgName'] = $tempArr;
        }

        self::$companyData = $dataArray;
        
        if ($result == false) {
            print("Произошла ошибка при выполнении запроса");
        }

        $this->createCard();
    }

    public function getCompanyData() 
    {
        echo "<pre>";
        print_r(self::$companyData);
        echo "</pre>";
    }

    private function createCard() 
    {
        ob_start();
        include("card.php");
        self::$cardOutputBuffer = ob_get_flush();
    }

    public static function getCard() 
    {
        echo self::$cardOutputBuffer;
    }
}

function calculate(string $filename, $ratioWidth, $ratioHeight) 
{
    $ratioCoefficient = $ratioWidth / $ratioHeight;
    $size = getimagesize($filename);
    //print_r($size);

    $realWidth = $size[0];
    $realHeight = $size[1];
    $coefficient = $realWidth / $realHeight;

    if ($coefficient > $ratioCoefficient) {
        $width = $ratioWidth;
        $heightNeed = $realWidth / $ratioCoefficient;
        $kHeight = $ratioHeight / $heightNeed;
        $height = $realHeight * $kHeight;
        $margin_top[0] = ($ratioHeight - $height) / 2;
        $margin_top[1] = "t";

        echo "width: ", $width;
        echo "*height: ", $height;

        return $margin_top;

    } elseif ($coefficient < $ratioCoefficient) {
        $height = $ratioHeight;
        $widthNeed = $realHeight * $ratioCoefficient;
        $kWidth = $ratioWidth / $widthNeed;
        $width = $realWidth * $kWidth;
        $margin_left[0] = ($ratioWidth - $width) / 2;
        $margin_left[1] = "l";

        echo "*width: ", $width;
        echo "height: ", $height;

        return $margin_left;
            
    } elseif ($coefficient = $ratioCoefficient) {
        $margin_none = array(0, 0);

        return $margin_none;
    }
}


$sql = "SELECT COUNT(*) FROM NSTU_company_list";
$result = mysqli_query($link, $sql);
$companyCount = mysqli_fetch_row($result);

$counter = 0;
while ($counter < $companyCount[0]) {
    $name = "company" . $counter;
    $$name = new companyCard($counter, $link);
    //$$name -> getCompanyData();
    $counter++;
}
?>
</div>