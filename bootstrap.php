<?php

use Flarum\Event\ConfigureLocales;
use Flarum\Event\ConfigureClientView;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->listen(ConfigureLocales::class, function (ConfigureLocales $event) {
        $event->loadLanguagePackFrom(__DIR__);
    });

    //Add assets
    $events->listen(ConfigureClientView::class,  function(ConfigureClientView $event) {
	if ($event->isForum()) {
           $event->addAssets([
              __DIR__ . '/less/forum/extension.less'
           ]);
        }
    });
};
