<?
class Arnly
{

	public function getHead ($arParams = [])
	{
		?>
		<meta charset="utf-8">
		<link href="/edisonv2/lib/vendors/bootstrap-5.1.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="/edisonv2/css/style.css" rel="stylesheet">
		<script src="/edisonv2/lib/vendors/bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
		<script src="/edisonv2/lib/vendors/jquery/jquery-3.6.0.min.js"></script>
		<script src="/edisonv2/js/script.js"></script>
		<?
	}

	/*
	PARAMS:
	NUMBER
	*/
	public function addData ($arParams = [])
	{
		$_SESSION['HISTORY'][] = $arParams['NUMBER'];
		Arnly::addAnswers(['USER' => 'USER_1', 'NUMBER' => $arParams['NUMBER']]);
		Arnly::addAnswers(['USER' => 'USER_2', 'NUMBER' => $arParams['NUMBER']]);

		return 1;
	}

	/*
	PARAMS:
	ID
	*/
	public function getData ($arParams = [])
	{
		return $_SESSION;
	}

	/*
	PARAMS:
	USER
	NUMBER
	*/
	protected function addAnswers ($arParams = [])
	{
		while (1)
		{
			$arResult['NUMBER'] = Arnly::getNumber();
			$_SESSION['ANSWERS'][$arParams['USER']][] = $arResult['NUMBER'];
			if ($arParams['NUMBER'] == $arResult['NUMBER'])
			{
				Arnly::updateAuthority(['USER' => $arParams['USER'], 'SUCCSESS' => 2]);
				break;
			}
			else
			{
				Arnly::updateAuthority(['USER' => $arParams['USER'], 'SUCCSESS' => -1]);
			}
		}
		
	}

	protected function getNumber ()
	{
		return rand(10, 99);
	}

	/*
	PARAMS:
	USER
	SUCCSESS
	*/
	protected function updateAuthority ($arParams = [])
	{
		if (!isset($_SESSION['AUTHORITY'][$arParams['USER']]))
			$_SESSION['AUTHORITY'][$arParams['USER']] = 1000;

		$_SESSION['AUTHORITY'][$arParams['USER']] = $_SESSION['AUTHORITY'][$arParams['USER']] + $arParams['SUCCSESS'];
	}

	/*
	PARAMS:
	TEMPLATE_NAME: .default
	*/
	public function getTemplate ($arParams = [])
	{
		if (!$arParams['TEMPLATE_NAME'])
			$arParams['TEMPLATE_NAME'] = '.default';

		if (!file_exists(dirname(__FILE__, 2).'/templates/'.$arParams['TEMPLATE_NAME'].'/template.php'))
			return Arnly::showError(['MESSAGE_NAME' => 'ARNLY_CLASS_NOT_FOUND_TEMPLATE']);

		require_once(dirname(__FILE__, 2).'/templates/'.$arParams['TEMPLATE_NAME'].'/template.php');
	}

	/*
	PARAMS:
	MESSAGE_NAME
	*/
	public function showError ($arParams = [])
	{
		if (!$arParams)
			return 'Произошла ошибка.'; 

		if (!$arParams['MESSAGE'])
			$arParams['MESSAGE'] = 'Произошла ошибка.';

		$arParams['MESSAGES'] = [
			'ARNLY_AJAX_NUMBER_NOT_INT' => 'Число не является целым числом.',
			'ARNLY_AJAX_NUMBER_NOT_DOUBLE_DIGIT' => 'Переданное число не двухзначное.',
			'ARNLY_AJAX_ERROR_SERVER' => 'Ошибка сервера.',
			'ARNLY_TEMPLATE_NOT_DATA' => 'Нет данных.',
		];

		return $arParams['MESSAGES'][$arParams['MESSAGE_NAME']] ?: htmlspecialchars($arParams['MESSAGE']);
	}
}
?>