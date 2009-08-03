<?php if (!empty($data['viewed'])){ ?>
<div id="keywords">
    <strong>Viewed Repos: </strong>
    <?php
        foreach ($data['viewed'] as $key => $value) {
            echo $html->link($value['repo'], array('browse' => 'index', $value['repo'], $value['owner'])) . ' ';
        }
    
    ?>
</div>
<?php } ?>