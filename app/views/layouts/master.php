<?php
/**
 * @var $this Template
 */
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Robust online billing:: <?php echo $this->getControllerVar('title', ''); ?></title>
	<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1 class="header">
	ROBT
</h1>
<?php $menu = array(); ?>

<?php if ($this->getWebUser()->isAuthenticated()): ?>
	<?php if ($this->getWebUser()->getModel()->hasAccess('admin')): ?>
		<?php
			$menu = array(
				array('Договоры', array('Contract', 'index')),
				array('Тарифы', array('Tariff', 'index')),
				array('Классы трафика', array('TrafficClass', 'index')),
				array('Типы начислений', array('ChargeType', 'index')),
			);
		?>
	<?php else: ?>
		<?php
			$menu = array(

			);
		?>
	<?php endif; ?>
	<?php $menu[] = array('Выйти', array('Auth', 'logout')); ?>
<?php endif; ?>
<nav>
	<ul class="site-navigation">
		<?php foreach ($menu as $item): ?>
			<li><a href="<?php echo $this->createUrl($item[1][0], $item[1][1]); ?>"><?php echo $item[0]; ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>



<section>
<?php echo $content; ?>
</section>

<footer>
	copyright glazhenebabarnaula 2012
</footer>
</body>
</html>
