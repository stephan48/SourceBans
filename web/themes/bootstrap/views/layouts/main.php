<?php Yii::app()->bootstrap->registerCoreCss() ?>
<?php Yii::app()->bootstrap->registerYiiCss() ?>
<?php Yii::app()->bootstrap->registerCoreScripts() ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sourcebans.js') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/template.js') ?>
<?php Yii::app()->clientScript->registerLinkTag('shortcut icon', 'image/x-icon', Yii::app()->baseUrl . '/images/favicon.ico') ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language ?>">
  <head>
    <title><?php if(!empty($this->title)) echo CHtml::encode($this->title . Yii::app()->params['titleSeparator']) ?><?php echo CHtml::encode(Yii::app()->name) ?></title>
    <meta charset="UTF-8" />
    <meta name="author" content="GameConnect" />
    <meta name="copyright" content="SourceBans © 2007-2013 GameConnect.net. All rights reserved." />
    <meta name="description" content="Advanced admin and ban management for the Source engine" />
  </head>
  <body id="<?php echo (!empty($this->pageId) ? $this->pageId : $this->id . '_' . $this->action->id); ?>">
    <header>
      <div class="container">
        <form action="<?php echo $this->createUrl('site/bans') ?>" class="input-append pull-right" id="search">
          <input class="span2" placeholder="<?php echo Yii::t('sourcebans', 'Search bans') ?>" name="q" type="search" />
          <button class="btn btn-inverse" type="submit"><i class="icon-search icon-white"></i></button>
        </form>
        
        <h1><?php echo CHtml::link(CHtml::encode(Yii::app()->name), array('site/index')) ?></h1>
        
        <div class="navbar">
          <nav class="navbar-inner">
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'tabs',
	'items' => array_merge(array(
		array(
			'active' => $this->route == 'site/dashboard' || ($this->route == 'site/index' && SourceBans::app()->settings->default_page == 'dashboard'),
			'label' => Yii::t('sourcebans', 'controllers.site.dashboard.title'),
			'url' => array('site/dashboard'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'This page shows an overview of your bans and servers.')),
		),
		array(
			'active' => $this->route == 'site/bans' || ($this->route == 'site/index' && SourceBans::app()->settings->default_page == 'bans'),
			'label' => Yii::t('sourcebans', 'controllers.site.bans.title'),
			'url' => array('site/bans'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'All of the bans in the database can be viewed from here.')),
		),
		array(
			'active' => $this->route == 'site/servers' || ($this->route == 'site/index' && SourceBans::app()->settings->default_page == 'servers'),
			'label' => Yii::t('sourcebans', 'controllers.site.servers.title'),
			'url' => array('site/servers'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'All of your servers and their status can be viewed here.')),
		),
		array(
			'active' => $this->route == 'site/submitban' || ($this->route == 'site/index' && SourceBans::app()->settings->default_page == 'submitban'),
			'label' => Yii::t('sourcebans', 'controllers.site.submitban.title'),
			'url' => array('site/submitban'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'You can submit a demo or screenshot of a suspected cheater here. It will then be up for review by one of the admins.')),
			'visible' => SourceBans::app()->settings->enable_submit,
		),
		array(
			'active' => $this->route == 'site/protestban' || ($this->route == 'site/index' && SourceBans::app()->settings->default_page == 'protestban'),
			'label' => Yii::t('sourcebans', 'controllers.site.protestban.title'),
			'url' => array('site/protestban'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'Here you can protest your ban. And prove your case as to why you should be unbanned.')),
			'visible' => SourceBans::app()->settings->enable_protest,
		),
		array(
			'active' => $this->id == 'admin',
			'label' => Yii::t('sourcebans', 'controllers.admin.index.title'),
			'url' => array('admin/index'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'This is the control panel for SourceBans where you can setup new admins, add new servers, etc.')),
			'visible' => !Yii::app()->user->isGuest,
		),
	), $this->tabs),
	'htmlOptions' => array(
		'class' => 'nav',
	),
)) ?>
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'user',
	'items' => array(
		array(
			'label' => Yii::app()->user->name,
			'url' => array('site/account'),
			'visible' => !Yii::app()->user->isGuest,
		),
		array(
			'label' => Yii::t('sourcebans', 'controllers.site.logout.title'),
			'url' => array('site/logout'),
			'visible' => !Yii::app()->user->isGuest,
		),
		array(
			'label' => Yii::t('sourcebans', 'controllers.site.login.title'),
			'url' => array('site/login'),
			'visible' => Yii::app()->user->isGuest,
		),
	),
	'htmlOptions' => array(
		'class' => 'nav pull-right',
	),
)) ?>

          </nav>
        </div>
      </div>
    </header>
    
    <div class="container">
      <header>
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'homeLink' => false,
	'links' => $this->breadcrumbs,
)) ?>

        <h2><?php echo CHtml::encode($this->pageTitle) ?></h2>
      </header>
      
<?php echo $content ?>
      
    </div>
    
    <footer>
      <div class="container">
        <p>
          <a href="http://sourcebans.net" target="_blank"><img alt="SourceBans" src="<?php echo Yii::app()->theme->baseUrl ?>/images/logo_footer.png" /></a>
          <br /><strong><?php echo Yii::t('sourcebans', 'Version') ?> <?php echo SourceBans::getVersion() ?></strong>
          <br />"<?php echo SourceBans::app()->quote->text ?>" - <em><?php echo SourceBans::app()->quote->name ?></em>
        </p>
      </div>
    </footer>
  </body>
</html>