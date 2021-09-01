<?
require_once(__DIR__.'/lib/class.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<?
		echo Arnly::getHead();
		?>
	</head>
	<body>
		<?
		echo Arnly::getTemplate([
			'TEMPLATE_NAME' => '.default',
		]);
		?>
	</body>
</html>