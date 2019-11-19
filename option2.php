<?php

include 'include/top.php';


$url = "https://weather-broker-cdn.api.bbci.co.uk/en/forecast/rss/3day/2643743";
$cache = "option2.xml";
$lifetime = 60 * 60 *24;
$xml = '';

if (file_exists($cache)) {
    $modified = filemtime($cache);
}

// create or update the cache if necessary
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


<div class = "container">
    <title>Weather in London</title>

<h1>What is the weather in London today?</h1>

<?php

  
date_default_timezone_set('EST');
   
     
if ($feed === false){
    echo '<p>Sorry, weather feed is unavailble</p>';
} else {
    foreach($feed->channel->item as $item){
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
        echo date("M") . "<br>";
        ?>
    </div>
    
    <div class="day">
        <?php
        echo date("j") . "<br>";
       
        ?>
    </div>
    
    <div class="day-of-week">
        <?php
        echo date("D") . "<br>";
        ?>
    </div>
</div>
        </div>
<?php
 
    }
   echo '<article>'; 
 
}
?>
</div>

<style>
    
    .container{
        padding-left:15%;
        padding-right:15%;
        padding-bottom:10%;
    }
    
    
    
    .date{
        display:block;
        border: 1px solid #ccc;
        border-radius: 5px;
        max-height: 62px;
        min-width: 50px;
        text-align: center;
        padding:10px;
        margin:20px;
        
    }
    .datewrapper{
        display:flex;
    }
    
    h1{
        padding: 25px 0px;
        font-size: 40px;
    }
    
    article{
        padding:0;
    }
</style>
<?php

include 'include/bottom.php';
?>