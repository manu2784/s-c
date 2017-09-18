<?php

function addScheme($url, $scheme = 'http://')
{
  return parse_url($url, PHP_URL_SCHEME) === null ?
    $scheme . $url : $url;
}

function liveRows ($allOffice, $alldata, $mode) {

  sort($allOffice);
$allOffice=array_unique($allOffice);

foreach ($allOffice as $office) { ?>

                    <li>
                    <h3 style="color: #666;font-family: 'GillSansBold', 'Lucida Grande', Arial;font-size: 16px;line-height: 24px;margin:0;text-transform: uppercase;"><?php echo $office; ?></h3>
                      <ul>
<?php 
          foreach ($alldata as $data) 
              { 

                $live=$data[0];
                $hotel_name=$data[1];
                $web_url=$data[2];

                $web_url=addScheme($web_url);
                $current_office=$data[3];

                  if ($live==$mode && $current_office== $office) 
                      { ?>
                              <ul>
                              <li><a href="<?php echo $web_url;?>" style="color: #9a4040;text-decoration: underline;"><?php echo $hotel_name;?></a></li>
                              </ul>

                     <?php }



              }
?>
                                    </ul>
                    </li>
 
<?php }

}

?>