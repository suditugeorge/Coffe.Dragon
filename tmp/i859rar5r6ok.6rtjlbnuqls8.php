<header id="header">
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigare</span>
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
                <li><a class="nav-text" href="/despre-noi"><span class="fonted medium">Despre noi</span></a></li>
                <li class="separator"> • </li>
                <li><a class="nav-text" href="/produse"><span class="fonted medium">Produse</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a class="nav-text" href="/contact"><span class="fonted medium">Contact</span></a></li><li class="separator"> • </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fonted medium">Cont</span><span class="caret"></span></a>
			          <ul class="dropdown-menu">
                  <?php if (is_array($_SESSION) && array_key_exists('user_id', $_SESSION) && isset($_SESSION['user_id'])): ?>
                    <li><a class="nav-text" href="/logout"><span class="fonted medium">Log out</span></a></li>
                    <?php else: ?><li><a class="nav-text" href="/login"><span class="fonted medium">Log in</span></a></li>
                  <?php endif; ?>
			            <li><a class="nav-text" href="/user-details"><span class="fonted medium">Detalii personale</span></a></li>
			          </ul>
			        </li>
            </ul>
        </div>
    </div>
	</nav>
</header>



