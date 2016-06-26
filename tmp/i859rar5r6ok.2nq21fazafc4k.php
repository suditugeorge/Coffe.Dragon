<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $title; ?> - Coffee Dragon</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script language ="JavaScript" src="/ui/vendor/js/jquery-2.2.4.min.js"></script>
        <script language ="JavaScript" src="/ui/vendor/js/bootstrap.min.js"></script>
        <script language ="JavaScript" src="/ui/vendor/js/loadCSS.js"></script>
        <link rel="icon" href="/images/logo-transparent.png">
        <link href="/ui/vendor/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/ui/css/main.css">
        
        <?php if (isset($pager)): ?>
            <?php if (array_key_exists('prev', $pager['rel'])): ?>
                    <link rel="prev" href="<?php echo 'https://'.MAIN_URL.$pager['rel']['prev']; ?>" />
            <?php endif; ?>
            <?php if (array_key_exists('next', $pager['rel'])): ?>
                    <link rel="next" href="<?php echo 'https://'.MAIN_URL.$pager['rel']['next']; ?>" />
            <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($description)): ?>
        		<meta name="description" content="<?php echo $description; ?>" />
        <?php endif; ?>
	</head>
<body id="top">
    <?php echo $this->render('html/layout/header.html',$this->mime,get_defined_vars(),0); ?>
    <?php if (isset($styles)): ?><?php foreach (($styles?:array()) as $style): ?>
        <script type="text/javascript">loadCSS("<?php echo data\StaticContent::css($style); ?>");</script>
    <?php endforeach; ?><?php endif; ?>
    <?php if (isset($scripts)): ?><?php foreach (($scripts?:array()) as $script): ?><script src="<?php echo $script; ?>"></script><?php endforeach; ?><?php endif; ?>
	<!-- Main -->
	<div id="main">
        <?php echo $this->render($content,$this->mime,get_defined_vars(),0); ?>
	</div>
    <?php echo $this->render('html/layout/footer.html',$this->mime,get_defined_vars(),0); ?>
</body>
</html>
