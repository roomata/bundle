<?php

namespace Roomata\CropBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('roomata_crop');

        $rootNode
            ->children()->arrayNode('thumbnail')
            ->useAttributeAsKey('small')
            ->arrayPrototype()
            ->children()
            ->integerNode('width')->isRequired()->end()
            ->integerNode('height')->isRequired()->end()
            ->end()
            ->end();
        return $treeBuilder;
    }
}
