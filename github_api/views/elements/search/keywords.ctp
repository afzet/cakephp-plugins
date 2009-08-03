<div id="keywords">
    <strong>Previous Search Terms: </strong>
    <?php
        foreach ($keywords as $key => $value) {
            echo $html->link($value, array('action' => 'index', $value)) . ' ';
        }
    
    ?>
</div>