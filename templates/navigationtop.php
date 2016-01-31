<?php
/**
 * @var \view\NavigationTopView $this
 */
?>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?=$this->getNavbarBrand()?></a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li><a href="<?=\router\RequestAnalyzer::getRedirectURL("")?>">Persönliche Statusseite</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laufwerke<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li ><a href="<?=\router\RequestAnalyzer::getRedirectURL("files")?>">Privat-Laufwerk</a></li>
                    </ul>
                </li>

                <li><a href="<?=\router\RequestAnalyzer::getRedirectURL("staffSearch")?>">Personensuche</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><div><a href="<?=\router\RequestAnalyzer::getRedirectURL("logout")?>" class="btn btn-danger btn-sm navbar-btn"><span class="glyphicon glyphicon-log-in"></span> Logout</a></div></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>
