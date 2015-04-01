<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ChannelBundle\Twig;

use Sylius\Bundle\ChannelBundle\Templating\Helper\ChannelHelper;

/**
 * Sylius channel Twig extension.
 *
 * @author Christian Daguerre <christian@daguer.re>
 */
class ChannelExtension extends \Twig_Extension
{
    /**
     * @var CurrencyHelper
     */
    protected $helper;

    /**
     * @param CurrencyHelper $helper
     */
    public function __construct(ChannelHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('sylius_channel', array($this, 'getCurrentChannel')),
        );
    }

    /**
     * Get a channel by code or current channel from channel context.
     *
     * @return ChannelInterface
     */
    public function getCurrentChannel()
    {
        return $this->helper->getCurrentChannel()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_channel';
    }
}
