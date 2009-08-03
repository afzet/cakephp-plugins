<h2>My Repos</h2>
<?

echo $this->element('viewed_repos', array('plugin' => 'github_api')) . '<br />'; 


if (isset($data)): 
?>
    
<?php echo $html->link('&laquo; Go Back', $data['info']['previous'], null, null, false); ?>
<table>
<?php
echo $html->tableHeaders(array('', 'Name', 'Age', 'Message', 'Actions'));
foreach ($data['tree'] as $key => $value):

    switch($value['type']) {
        case 'blob':           
            $url = $html->link(
                $html->image('/'.$this->plugin.'/img/view.png'), 
                array(
                    'action' => 'blob', 
                    $data['info']['owner'], 
                    $data['info']['repo'], 
                    $value['tree'], 
                    $value['name']
                ),
                null, null, false
            );
            break;
        default:       
            $url = '';
    }
    
    echo $html->tableCells(
        array(
            $html->image('/'.$this->plugin.'/img/'.$value['type'].'.png'),
            $value['name'],
            $value['date'],
            $value['message'].'['.$value['author'].']',
            $url
        ), 
		array('class'=>'row'),
		array('class'=>'altrow')  
    );

endforeach;
?>
<table>
<? endif; ?>