<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Contao\Bundle\CoreBundle\HttpKernel;

use Contao\System;
use Contao\Bundle\CoreBundle\Autoload\BundleAutoloader;
use Contao\Bundle\CoreBundle\DependencyInjection\Compiler\AddBundlesToCachePass;
use Contao\Bundle\CoreBundle\HttpKernel\Bundle\ContaoBundleInterface;
use Contao\Bundle\CoreBundle\HttpKernel\Bundle\ContaoLegacyBundle;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Custom Contao kernel
 *
 * @author Leo Feyer <https://contao.org>
 */
abstract class ContaoKernel extends Kernel implements ContaoKernelInterface
{
    /**
     * @var array
     */
    protected $bundlesMap = [];

    /**
     * @var array
     */
    protected $contaoBundles = [];

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        System::setKernel($this);

        parent::boot();
    }

    /**
     * {@inheritdoc}
     */
    public function addAutoloadBundles(&$bundles)
    {
        if (empty($this->bundlesMap)) {
            $this->bundlesMap = $this->findAutoloadBundles();
        }

        foreach ($this->bundlesMap as $package => $class) {
            if (null !== $class) {
                $bundles[] = new $class();
            } else {
                $bundles[] = new ContaoLegacyBundle($package, $this->getRootDir());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getContaoBundles()
    {
        if (empty($this->contaoBundles)) {
            foreach ($this->getBundles() as $bundle) {
                if ($bundle instanceof ContaoBundleInterface) {
                    $this->contaoBundles[] = $bundle;
                }
            }
        }

        return $this->contaoBundles;
    }

    /**
     * {@inheritdoc}
     */
    public function writeBundleCache()
    {
        file_put_contents(
            $this->getCacheDir() . '/bundles.map',
            sprintf('<?php return %s;', var_export($this->bundlesMap, true))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadBundleCache()
    {
        if (empty($this->bundlesMap) && is_file($this->getCacheDir() . '/bundles.map')) {
            $this->bundlesMap = include $this->getCacheDir() . '/bundles.map';
        }
    }

    /**
     * Find the autoload bundles
     *
     * @return array The bundles array
     */
    protected function findAutoloadBundles()
    {
        $autoloader = new BundleAutoloader($this->getRootDir(), $this->getEnvironment());

        return $autoloader->load();
    }

    /**
     * {@inheritdoc}
     */
    protected function buildContainer()
    {
        $container = parent::buildContainer();
        $container->addCompilerPass(new AddBundlesToCachePass($this));

        return $container;
    }
}
