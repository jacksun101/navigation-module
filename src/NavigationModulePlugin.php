<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Command\GetLinks;
use Anomaly\NavigationModule\Link\Command\RenderNavigation;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class NavigationModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'nav_menu',
                function ($menu, array $parameters = []) {
                    return $this->dispatch(new RenderNavigation((new Collection($parameters))->put('menu', $menu)));
                },
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'nav',
                function ($menu = null) {
                    return new PluginCriteria(
                        'render',
                        function (Collection $options) use ($menu) {
                            return $this->dispatch(new RenderNavigation($options->put('menu', $menu)));
                        }
                    );
                },
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'menu',
                function ($menu = null) {
                    return new PluginCriteria(
                        'render',
                        function (Collection $options) use ($menu) {
                            return $this->dispatch(new RenderNavigation($options->put('menu', $menu)));
                        }
                    );
                },
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'links',
                function ($menu = null) {
                    return new PluginCriteria(
                        'get',
                        function (Collection $options) use ($menu) {
                            return (new Decorator())->decorate(
                                $this->dispatch(new GetLinks($options->put('menu', $menu)))
                            );
                        }
                    );
                }
            )
        ];
    }
}
