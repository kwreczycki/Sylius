<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ChannelBundle\Templating\Helper;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Sylius channel Twig helper.
 *
 * @author Christian Daguerre <christian@daguer.re>
 */
class ChannelHelper extends Helper
{
    /**
     * Channel context.
     *
     * @var ChannelContextInterface
     */
    private $channelContext;

    public function __construct(ChannelContextInterface $channelContext)
    {
        $this->channelContext = $channelContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentChannel()
    {
        return $this->channelContext->getChannel();
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     *
     * @api
     */
    public function getName()
    {
        return 'sylius_channel';
    }
}
