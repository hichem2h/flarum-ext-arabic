<?php

use Flarum\Event\ConfigureLocales;
use Flarum\Event\ConfigureClientView;
use Flarum\Forum\WebApp;
use Flarum\Locale\LocaleManager;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->listen(ConfigureLocales::class, function (ConfigureLocales $event) {
        $event->loadLanguagePackFrom(__DIR__);
    });

    //Add assets
    $events->listen(ConfigureClientView::class,  function(ConfigureClientView $event) {
      $webapp = app(WebApp::class);
	$assets = $webapp-> getAssets();
	$assets->flushLocaleCss();
      $locales = app(LocaleManager::class);

      if ($event->isForum() && $locales->getLocale() == "ar") {
           $event->addAssets([
              __DIR__ . '/less/forum/extension.less'
           ]);
	   // change the html dir tag from ltr to rtl 
	   $event->view->direction = 'rtl';   
        }
    });
};

