<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $title; ?> - Coffee Dragon</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <?php if (isset($pager)): ?>
            <?php if (array_key_exists('prev', $pager['rel'])): ?>
                    <link rel="prev" href="<?php echo 'https://'.MAIN_URL.$pager['rel']['prev']; ?>" />
            <?php endif; ?>
            <?php if (array_key_exists('next', $pager['rel'])): ?>
                    <link rel="next" href="<?php echo 'https://'.MAIN_URL.$pager['rel']['next']; ?>" />
            <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($robots)): ?>
        		<meta name="robots" content="<?php echo $robots; ?>">
        <?php endif; ?>
        <?php if (isset($description)): ?>
        		<meta name="description" content="<?php echo $description; ?>" />
        <?php endif; ?>
	</head>
<body id="top">
    <?php echo $this->render('html/layout/header.html',$this->mime,get_defined_vars(),0); ?>
		<!-- Main -->
        
</body>
</html>
