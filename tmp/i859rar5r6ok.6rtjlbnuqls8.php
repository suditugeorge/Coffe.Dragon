<header id="header">
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="logo hidden">
      	  <a href="/">
        		<img alt="Coffee Dragon" src="/images/logo-navBar.png">
      		</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a class="nav-text" href="/despre-noi">Despre noi</a></li>
                <li class="separator"> • </li>
                <li><a class="nav-text" href="/produse">Produse</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a class="nav-text" href="/contact">Contact</a></li><li class="separator"> • </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cont<span class="caret"></span></a>
			          <ul class="dropdown-menu">
                  <?php if (is_array($_SESSION) && array_key_exists('user_id', $_SESSION) && isset($_SESSION['user_id'])): ?>
                    <li><a class="nav-text" href="/logout">Log out</a></li>
                    <?php else: ?><li><a class="nav-text" href="/login">Log in</a></li>
                  <?php endif; ?>
			            <li><a class="nav-text" href="/user-details">Detalii personale</a></li>
			          </ul>
			        </li>
            </ul>
        </div>
    </div>
	</nav>
</header>



