<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdminTest\Entities;

use EnliteAdmin\Configuration;
use EnliteAdmin\Entities\Container;
use EnliteAdmin\Entities\ContainerFactory;

class ContainerFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateService()
    {
        $config = new Configuration(
            array(
                 'entities' => array(
                     'user' => array()
                 )
            )
        );

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceManager', ['get']);
        $serviceLocator->expects($this->once())->method('get')->with('EnliteAdminConfiguration')->will($this->returnValue($config));

        $factory = new ContainerFactory();
        /** @var Container $container */
        $container = $factory->createService($serviceLocator);
        $this->assertInstanceOf('EnliteAdmin\Entities\Container', $container);
        $this->assertCount(1, $container->getEntities());
        $this->assertInstanceOf('EnliteAdmin\Entities\Entity', $container->getEntity('user'));
    }

}
