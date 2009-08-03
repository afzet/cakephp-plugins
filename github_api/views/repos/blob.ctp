<h2><?php echo $data['name']; ?></h2>
<?php 
echo $this->element('syntax/render');
echo $html->link('&laquo; Go Back', $info['previous'], null, null, false);
list($file, $type) = explode('.', $data['name']); 
switch ($type) {
	case 'ctp':
	case 'gitignore':
	case 'htaccess':
		$filetype = 'php';
		break;
	case 'rb':
		$filetype = 'ruby';
		break;
	case 'xml':
		$filetype = 'xml';
		break;
	default:
		$filetype = $type;
}
?>
<pre name="code" class="<?php echo $filetype; ?>">
<?php echo htmlentities(trim($data['data'])); ?>
</pre>