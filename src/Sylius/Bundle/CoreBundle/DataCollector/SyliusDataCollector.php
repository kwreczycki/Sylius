<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\DataCollector;

use Sylius\Bundle\CoreBundle\Kernel\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Currency\Context\CurrencyContextInterface;

class SyliusDataCollector extends DataCollector
{
    protected $currencyContext;
    protected $channelContext;

    /**
     * Constructor.
     *
     * @param CurrencyContextInterface $currencyContext
     * @param ChannelContextInterface  $channelContext
     */
    public function __construct(CurrencyContextInterface $currencyContext, ChannelContextInterface $channelContext)
    {
        $this->currencyContext = $currencyContext;
        $this->channelContext  = $channelContext;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['version'] = Kernel::VERSION;
        $this->data['currency'] = $this->currencyContext->getCurrency();
        $this->data['channel'] = $this->channelContext->getChannel();
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->data['version'];
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->data['currency'];
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->data['channel'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius';
    }
}
