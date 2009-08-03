<?php
echo $form->create('Repo', array('action' => 'search'));
echo $form->input('name');
echo $form->end('Search');

echo $this->element('searched_terms', array('plugin' => 'github_api')) . '<br />'; 


if (isset($data)): 
?>

<table>
<?php
echo $html->tableHeaders(array('Name', 'Owner', 'Description', 'Followers', 'Forks',  'Commits'));
foreach ($data['repositories'] as $key => $value):
    echo $html->tableCells(
        array(
            $value['name'],
            $value['username'],
            $value['description'],  
            $value['followers'],  
            $value['forks'],    
            $html->link($html->image('/'.$this->plugin.'/img/tree.png'), array('action' => 'browse', $value['username'], $value['name']), null, null, false).' '.$html->link($html->image('/'.$this->plugin.'/img/info.png'), array('action' => 'commits', $value['username'], $value['name']), null, null, false)
        ), 
		array('class'=>'row'),
		array('class'=>'altrow')  
    );

endforeach;
?>
<table>
<? endif; ?>