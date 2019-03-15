<?php

namespace Grav\Plugin;

use Grav\Common\Config\Config;
use Grav\Common\Plugin;
use Grav\Common\Twig\TwigEnvironment;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class EmbedPrivacyPlugin
 *
 * @package Grav\Plugin
 */
class EmbedPrivacyPlugin extends Plugin
{
    /**
     * Initializes this plugin.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onTwigInitialized'   => ['onTwigInitialized', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ];
    }

    /**
     * Adds needed assets
     *
     * @return void
     */
    public function onTwigSiteVariables()
    {
        if ($this->active) {
            $this->grav['assets']->add('plugin://embed-privacy/assets/css/embed-privacy.css');
            $this->grav['assets']->add('plugin://embed-privacy/assets/js/embed-privacy.js');
        }
    }

    /**
     * Adds twig functionality
     *
     * @param Event $e
     */
    public function onTwigInitialized(Event $e)
    {
        $this->grav['twig']->twig()->addFilter(
            new \Twig_SimpleFilter('embedprivacy', [$this, 'embedPrivacy'])
        );
        $this->grav['twig']->twig()->addFunction(
            new \Twig_SimpleFunction('embedprivacy', [$this, 'embedPrivacy'])
        );
    }

    /**
     * Initializes twig for rendering.
     *
     * @return TwigEnvironment
     */
    private function getTwig()
    {
        /** @var \Twig_Loader_Filesystem $loader */
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
        /** @var TwigEnvironment $twig */
        $twig = new \Twig_Environment($loader, ['debug' => FALSE]);

        return $twig;
    }

    /**
     * Converts a service url (like a YouTube link) to a privacy secured embedded link.
     *
     * @param string $serviceUrl
     *
     * @return string
     */
    public function embedPrivacy($serviceUrl)
    {
        /** @var Config $config */
        $config = $this->grav['config'];
        if (empty($serviceUrl)) return '';
        if (!$config->get('plugins.embed-privacy.iframely_enabled')) return '';
        try {
            /** @var TwigEnvironment $twig */
            $twig = $this->getTwig();

            if ($config->get('plugins.embed-privacy.iframely_enabled') && !empty($config->get('plugins.embed-privacy.iframely_baseurl'))) {
                $service_embed = '';
                //TODO switch w/ curl
                $iframelyResponse = @file_get_contents($config->get('plugins.embed-privacy.iframely_baseurl') . '/iframely?url=' . $serviceUrl);
                if (FALSE !== $iframelyResponse) {
                    $iframelyResponse = json_decode($iframelyResponse, TRUE);
                    if (isset($iframelyResponse['links']['player'][0]['html'])) {
                        $service_embed = $iframelyResponse['links']['player'][0]['html'];
                    } else if (isset($iframelyResponse['html'])) {
                        $service_embed = $iframelyResponse['html'];
                    }
                }

                if ($service_embed !== '') {
                    $data = [
                        'service_embed' => $service_embed
                    ];

                    return $twig->render('embedprivacy.html.twig', $data);
                }
            }
        } catch (\Exception $e) {
            return 'Could not load response from ' . $serviceUrl;
        }

        return '';
    }
}
