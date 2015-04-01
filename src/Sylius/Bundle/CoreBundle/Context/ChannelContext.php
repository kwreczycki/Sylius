<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Context;

use Sylius\Component\Channel\Context\ChannelContext as BaseChannelContext;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Bundle\SettingsBundle\Manager\SettingsManagerInterface;
use Sylius\Component\Core\Channel\ChannelResolverInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Core channel context, which is aware of multiple channels.
 *
 * @author Kristian Løvstrøm <kristian@loevstroem.dk>
 * @author Christian Daguerre <christian@daguer.re>
 */
class ChannelContext extends BaseChannelContext implements ChannelContextInterface
{
    /**
     * @var ChannelResolverInterface
     */
    protected $channelResolver;

    /**
     * @var SettingsManagerInterface
     */
    protected $settingsManager;

    /**
     * @param ChannelResolverInterface $channelResolver
     * @param SettingsManagerInterface $settingsManager
     */
    public function __construct(ChannelResolverInterface $channelResolver, SettingsManagerInterface $settingsManager, $channelRepository)
    {
        $this->channelResolver = $channelResolver;
        $this->channelRepository = $channelRepository;
        $this->settingsManager = $settingsManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultChannel()
    {
        return $this->settingsManager->loadSettings('general')->get('channel');
    }

    /**
     * @inheritdoc
     */
    public function onKernelRequest(KernelEvent $event)
    {
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            $this->channel = $this->channelResolver->resolve($event->getRequest());

            if (null === $this->channel) {
                $this->channel = $this->channelRepository->findByCode($this->getDefaultChannel());
            }

            if (null === $this->channel) {
                throw new \RuntimeException('Unable to determine current or default channel.');
            }
        }
    }
}
