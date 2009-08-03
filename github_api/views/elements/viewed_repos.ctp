<?php if (!empty($keywords)){ ?>
<div id="keywords">
    <strong>Viewed Search Terms: </strong>
    <?php
        foreach ($keywords as $key => $value) {
            echo $html->link($value, array('browse' => 'index', $value['repo'], $value['owner'])) . ' ';
        }
    
    ?>
</div>
<?php } ?>