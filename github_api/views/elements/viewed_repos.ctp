<?php if (!empty($data['viewed'])){ ?>
<div id="keywords">
    <strong>Viewed Search Terms: </strong>
    <?php
        foreach ($data['viewed'] as $key => $value) {
            echo $html->link($value, array('browse' => 'index', $value['repo'], $value['owner'])) . ' ';
        }
    
    ?>
</div>
<br />
<?php } ?>