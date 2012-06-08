<?php
/**
 * @var $user User
 */
$user = Moskva::getInstance()->getUser()->getModel();
?>
<h2>Здравствуйте, <?php echo htmlspecialchars($user->getUsername()); ?>!</h2>
<br/>
Вы залогинились под аккаунтом администратора, будьте осторожны!