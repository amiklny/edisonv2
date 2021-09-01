<div class="container">
	<div class="row">
		<div class="d-flex col arnly-main-top" style="height: 100px">
			Загадайте число
		</div>
	</div>
	<div class="row">
		<div class="d-flex col">
			<div class="input-group">
			  <input type="text" name="arnly-value" class="form-control" placeholder="Введите двухзначное число">
			  <button class="btn btn-outline-success arnly-send-to-ajax" type="button">Подтвердить</button>
			</div>
		</div>
		<div class="d-flex col flex-column">
			Загаданные числа:<br>
			<span class="arnly-history">
				<?
					echo Arnly::showError(['MESSAGE_NAME' => 'ARNLY_TEMPLATE_NOT_DATA']);
				?>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="d-flex col">
		</div>
		<div class="d-flex col flex-column">
			Ответы экстрасенсов:<br>
			<span class="arnly-answers">
			<?
				echo Arnly::showError(['MESSAGE_NAME' => 'ARNLY_TEMPLATE_NOT_DATA']);
			?>
		</div>
	</div>
	<div class="row">
		<div class="d-flex col">
			<div class="arnly-log-wrapper"></div>
		</div>
		<div class="d-flex col flex-column">
			Авторитет экстрасенсов:<br>
			<span class="arnly-authority">
			<?
				echo Arnly::showError(['MESSAGE_NAME' => 'ARNLY_TEMPLATE_NOT_DATA']);
			?>
			</span>
		</div>
	</div>
</div>