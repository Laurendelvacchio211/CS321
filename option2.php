<?php

include 'include/top.php';


$url = "https://weather-broker-cdn.api.bbci.co.uk/en/forecast/rss/3day/2643743";
$cache = "option2.xml";
$lifetime = 60 * 60 *24;
$xml = '';

if (file_exists($cache)) {
    $modified = filemtime($cache);
}
 
if (!isset($modified) || $modified + $lifetime < time()) {
    if ($xml ===  file_get_contents($url)) {
        file_put_contents($cache, $xml);
    }
}

// if the cache file exists, suppress errors
// and load it as SimpleXML
if (file_exists($cache)) {
    libxml_use_internal_errors(true);
    $feed = simplexml_load_file($cache);
} else {
    $feed = false;
}
?>


 
<div class = "container5">
    <ul class="breadcrumb">
        <li style="padding-right:0px;"><a href="../index.php">Home</a></li>
       <li>Weather</li>

</ul>
   

<h1>What is the weather in London today?</h1>

<?php

  
date_default_timezone_set('EST');
   
     
if ($feed === false){
    echo '<p>Sorry, weather feed is unavailble</p>';
} else {
    $count = 0;
    foreach($feed->channel->item as $item){
        if( $count === 0 ){
            $today = strtotime( $item->pubDate );
            $today_timestamp = mktime( 0, 0, 0, date('n', $today), date('j', $today), date('Y', $today ));
        } else {
            $today_timestamp = $today_timestamp + 86400 ;
        }
        $count++;
        
     echo '<article>';
     ?>
        <div class="datewrapper">
            <div class="title">
      <?php
        echo "<h2><a href = '$item->link'->$item->title</a></h2>";
        echo "<p>$item->description</p>";
       ?>
            </div>
          
<div class="date">
    <?php
    $date = "today";
    $enddate = '2019-11-29';
   
 
     ?>   
    <div class="month">
        <?php
        echo date("M", $today_timestamp) . "<br>";
        ?>
    </div>
    
    <div class="day">
        <?php
        echo date("j", $today_timestamp) . "<br>";
       
        ?>
    </div>
    
    <div class="day-of-week">
        <?php
        echo date("D", $today_timestamp) . "<br>";
        ?>
    </div>
</div>
        </div>

<?php
 
    
   echo '</article>'; 
 

?>
<?php
 
    }
   echo '<article>'; 
 
}
?>
<?php
 
    
   echo '</article>'; 
 

?>
</div>


<?php

include 'include/bottom.php';
?>

