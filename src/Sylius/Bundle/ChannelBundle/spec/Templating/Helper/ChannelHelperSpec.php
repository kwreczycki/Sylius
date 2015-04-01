<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ChannelBundle\Templating\Helper;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Channel\Context\ChannelContextInterface;

/**
 * @author Christian Daguerre <christian@daguer.re>
 */
class ChannelHelperSpec extends ObjectBehavior
{
    function let(
        ChannelContextInterface $channelContext,
    ) {
        $this->beConstructedWith($channelContext, $converter, $moneyHelper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ChannelBundle\Templating\Helper\ChannelHelper');
    }

    function it_is_a_Twig_extension()
    {
        $this->shouldHaveType('Symfony\Component\Templating\Helper\Helper');
    }
}
