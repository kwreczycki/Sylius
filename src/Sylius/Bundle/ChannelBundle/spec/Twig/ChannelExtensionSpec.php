<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ChannelBundle\Twig;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ChannelBundle\Templating\Helper\ChannelHelper;

/**
 * @author Christian Daguerre <christian@daguer.re>
 */
class ChannelExtensionSpec extends ObjectBehavior
{
    function let(ChannelHelper $helper)
    {
        $this->beConstructedWith($helper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\ChannelBundle\Twig\ChannelExtension');
    }

    function it_is_a_Twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }
}
