<form action="<?php echo $this->createUrl('Auth', 'login'); ?>" method="POST">
	<?php if ($badAttempt): ?>
	<div class="error">Неправильные логин/пароль</div>
	<?php endif; ?>
	Логин: <input type="text" name="m_login" value="<?php echo isset($_POST['m_login']) ? $_POST['m_login'] : ''; ?>"><br/>
	Пароль: <input type="password" name="m_password" value="<?php echo isset($_POST['m_password']) ? $_POST['m_password'] : ''; ?>"><br/>
	<input type="submit" value="Войти">
</form>