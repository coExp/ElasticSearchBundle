<?php

namespace Headoo\ElasticSearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('headoo_elastic_search');

        $rootNode->children()
                ->arrayNode('connections')
                ->isRequired()
                ->cannotBeEmpty()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('host')->end()
                            ->scalarNode('port')->end()
                            ->scalarNode('timeout')->end()
                            ->scalarNode('connectTimeout')->end()
                            ->end()
                        ->end()
                    ->end()
                ->arrayNode('mappings')
                ->isRequired()
                ->cannotBeEmpty()
                    ->prototype('array')
                        ->children()
                            ->variableNode('mapping')->end()
                            ->scalarNode('class')->end()
                            ->variableNode('index')->end()
                            ->scalarNode('transformer')->end()
                            ->booleanNode('auto_event')->end()
                            ->scalarNode('connection')->end()
                            ->scalarNode('index_name')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end();

        return $treeBuilder;
    }
}
