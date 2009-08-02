<h2>Commits</h2>
<? if (isset($data)): ?>
    
<?php echo $html->link('&laquo; Go Back', $data['info']['previous'], null, null, false); ?>
<table>
<?php
echo $html->tableHeaders(array('Commit', 'Author', 'Age', 'Message', 'Browse'));
foreach ($data['commits'] as $key => $value):
    
    echo $html->tableCells(
        array(
            $value['id'],
            $value['committer']['name'],
            $value['committed_date'],
            $value['message'],
            $html->link($html->image('/'.$this->plugin.'/img/tree.png'), array('action' => 'tree', $data['info']['owner'], $data['info']['repo'], $value['tree']), null, null, false)
        ), 
		array('class'=>'row'),
		array('class'=>'altrow')  
    );

endforeach;
?>
<table>
<? endif; ?>