<?php if (!empty($data['keywords'])){ ?>
<div id="keywords">
    <strong>Previous Search Terms: </strong>
    <?php
        foreach ($data['keywords'] as $key => $value) {
            echo $html->link($value, array('action' => 'index', $value)) . ' ';
        }
    
    ?>
</div>
<br />
<?php } ?>