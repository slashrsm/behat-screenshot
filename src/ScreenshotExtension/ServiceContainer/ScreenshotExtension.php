<?php

namespace slashrsm\screenshot\ScreenshotExtension\ServiceContainer;

use Behat\Behat\Context\ServiceContainer\ContextExtension;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Screenshot extension for Behat.
 */
class ScreenshotExtension implements ExtensionInterface {

  /**
   * {@inheritDoc}
   */
  public function getConfigKey() {
    return 'screenshot';
  }

  /**
   * {@inheritDoc}
   */
  public function initialize(ExtensionManager $extensionManager) {}

  /**
   * {@inheritDoc}
   */
  public function load(ContainerBuilder $container, array $config) {
    // Add screenshot parameters.
    $screenshot_parameters = array();
    foreach ($config as $key => $value) {
      $screenshot_parameters[$key] = $value;
    }
    $container->setParameter('screenshot.parameters', $screenshot_parameters);

    // Register context initializer.
    $definition = new Definition(
      'slashrsm\screenshot\ScreenshotExtension\Context\Initializer\ScreenshotAwareInitializer',
      ['%screenshot.parameters%']
    );
    $definition->addTag(ContextExtension::INITIALIZER_TAG);
    $container->setDefinition('screenshot.context_initializer', $definition);
  }

  /**
   * {@inheritDoc}
   */
  public function process(ContainerBuilder $container) {
    $a = 1;
  }

  /**
   * {@inheritDoc}
   */
  public function configure(ArrayNodeDefinition $builder) {
    $builder->
      children()->
        booleanNode('enabled_on_fail')->
          defaultFalse()->
          info('Enables screenshot creation after step fail.')->
        end()->
        booleanNode('enabled_always')->
          defaultFalse()->
          info('Enables screenshot creation after every step.')->
        end()->
        scalarNode('screenshot_path')->
          defaultValue('/tmp')->
          info('Default save location for screenshots.')->
      end()->
    end();
  }

}
