<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Sulu\Component\HttpKernel\SuluKernel;

/**
 * The abstract kernel holds everything that is common between
 * AdminKernel and WebsiteKernel
 */
abstract class AbstractKernel extends SuluKernel
{
    /**
     * {@inheritDoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            // symfony standard
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // symfony cmf
            new Symfony\Cmf\Bundle\CoreBundle\CmfCoreBundle(),

            // doctrine extensions
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\PHPCRBundle\DoctrinePHPCRBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            // rest
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),

            // massive
            new Massive\Bundle\SearchBundle\MassiveSearchBundle(),

            // sulu
            new Sulu\Bundle\ContactBundle\SuluContactBundle(),
            new Sulu\Bundle\MediaBundle\SuluMediaBundle(),
            new Sulu\Bundle\SecurityBundle\SuluSecurityBundle(),
            new Sulu\Bundle\CategoryBundle\SuluCategoryBundle(),
            new Sulu\Bundle\SnippetBundle\SuluSnippetBundle(),
            new Sulu\Bundle\ContentBundle\SuluContentBundle(),
            new Sulu\Bundle\CoreBundle\SuluCoreBundle(),
            new Sulu\Bundle\TagBundle\SuluTagBundle(),
            new Sulu\Bundle\WebsiteBundle\SuluWebsiteBundle(),
            new Sulu\Bundle\LocationBundle\SuluLocationBundle(),
            new Sulu\Bundle\HttpCacheBundle\SuluHttpCacheBundle(),
            new Sulu\Bundle\WebsocketBundle\SuluWebsocketBundle(),
            new Sulu\Bundle\ProductBundle\SuluProductBundle(),
            new Sulu\Bundle\SearchBundle\SuluSearchBundle(),
            new Sulu\Bundle\Sales\CoreBundle\SuluSalesCoreBundle(),
            new Sulu\Bundle\Sales\OrderBundle\SuluSalesOrderBundle(),
            new Sulu\Bundle\Sales\ShippingBundle\SuluSalesShippingBundle(),

            // website
            new Client\Bundle\WebsiteBundle\ClientWebsiteBundle(),
            new Liip\ThemeBundle\LiipThemeBundle(),

            // tools
            new Massive\Bundle\BuildBundle\MassiveBuildBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // symfony standard
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();


            // debug enhancement
            $bundles[] = new Sulu\Bundle\TestBundle\SuluTestBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritDoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/' . $this->getContext() . '/config_' . $this->getEnvironment() . '.yml');

        $userConfig = __DIR__ . '/config/config.local.yml';

        if (file_exists($userConfig)) {
            $loader->load($userConfig);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getCacheDir()
    {
        return $this->rootDir . '/cache/' . $this->getContext() . '/' . $this->environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getLogDir()
    {
        return $this->rootDir . '/logs/' . $this->getContext() . '/' . $this->environment;
    }
}
