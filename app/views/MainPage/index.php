<?php
/**
 * @var $user User
 */
$user = Moskva::getInstance()->getUser()->getModel();
?>
<h2>Здравствуйте, <?php echo $user->getContract()->getFirstName(); ?>!</h2>
<br/>
<b>У вас на счету:</b> <?php echo $user->getContract()->getBalance(); ?> рублей