<?
require_once(__DIR__.'/class.php');

header('Content-Type: application/json');

$arJsonData['error'] = [];
$arResult = [];

if (!is_int((int)$_REQUEST['NUMBER']))
	$arJsonData['error'][] = Arnly::showError(['MESSAGE_NAME' => 'ARNLY_AJAX_NUMBER_NOT_INT']);
else if (strlen($_REQUEST['NUMBER']) !== 2)
	$arJsonData['error'][] = Arnly::showError(['MESSAGE_NAME' => 'ARNLY_AJAX_NUMBER_NOT_DOUBLE_DIGIT']);


if (!$arJsonData['error'])
{
	if (Arnly::addData(['NUMBER' => $_REQUEST['NUMBER']]))
	{
		$arResult = Arnly::getData();
		$arJsonData['success'] = 1;
	}
	else
	{
		$arJsonData['error'][] = Arnly::showError(['MESSAGE_NAME' => 'ARNLY_AJAX_ERROR_SERVER']);
	}
}

if ($arJsonData['error'])
	$arJsonData = ['result' => 'error', 'output' => '', 'message' => implode(', ', $arJsonData['error'])];
else if ($arJsonData['success'])
	$arJsonData = ['result' => 'success', 'output' => $arResult];

echo json_encode($arJsonData);
?>