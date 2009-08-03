<h2>My Repos</h2>
<?

if (isset($data)): 
echo '<h3>'.$data['info']['repo'].'</h3>';
?>
<br />
<?php echo $html->link('&laquo; Go Back', $data['info']['previous'], null, null, false); ?>
<br />
<table>
<?php
echo $html->tableHeaders(array('', 'Name', 'Age', 'Message', 'Hash', 'Actions'));
foreach ($data['tree'] as $key => $value):

    switch($value['type']) {
        case 'blob':           
            $url = $html->link(
                $html->image('/'.$this->plugin.'/img/view.png'), 
                array(
                    'action' => 'blob', 
                    $data['info']['owner'], 
                    $data['info']['repo'], 
                    $data['info']['tree'], 
                    $value['name']
                ),
                null, null, false
            );
            break;
        default:             
            $url = $html->link(
                $html->image('/'.$this->plugin.'/img/tree.png'), 
                array(
                    'action' => 'subtree', 
                    $data['info']['owner'], 
                    $data['info']['repo'], 
                    $value['sha']
                ),
                null, null, false
            );
    }
    
    echo $html->tableCells(
        array(
            $html->image('/'.$this->plugin.'/img/'.$value['type'].'.png'),
            $value['name'],
            $time->relativeTime($value['date']),
            $value['message'].'['.$value['author'].']',
            $value['sha'],
            $url
        ), 
		array('class'=>'row'),
		array('class'=>'altrow')  
    );

endforeach;
?>
<table>
<? endif; ?>