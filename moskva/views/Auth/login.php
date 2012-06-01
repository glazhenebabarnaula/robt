<form id="login" method="POST" action="<?php echo $this->createUrl('Auth', 'login'); ?>" >
	<h1>Вход в систему</h1>
	<?php if ($badAttempt): ?>
	<div class="error">Неправильные логин/пароль</div>
	<?php endif; ?>
	<fieldset>
		<ol>
			<li>
				<label for="username">Идентификатор</label>
				<input type="text" name="m_login" id="username" value="<?php echo isset($_POST['m_login']) ? $_POST['m_login'] : ''; ?>">
			</li>
			<li>
				<label for="password">Пароль</label>
				<input type="password" id="password" name="m_password" value="<?php echo isset($_POST['m_password']) ? $_POST['m_password'] : ''; ?>"><br/>
			</li>
		</ol>
	</fieldset>
	<input type="submit" name="Войти" value="Войти"/>
</form>