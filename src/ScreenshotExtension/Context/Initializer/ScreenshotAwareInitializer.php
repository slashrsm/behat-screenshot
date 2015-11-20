<?php

namespace slashrsm\screenshot\ScreenshotExtension\Context\Initializer;

use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\Behat\Context\Context;
use slashrsm\screenshot\ScreenshotExtension\Context\ScreenshotAwareInterface;

/**
 * Initializes screenshot contexts.
 */
class ScreenshotAwareInitializer implements ContextInitializer {

  /**
   * Screenshot extension parameters.
   *
   * @var array
   */
  protected $parameters;

  /**
   * Constructs ScreenshotAwareInitializer.
   *
   * @param array $parameters
   *   Screenshot extension parameters.
   */
  public function __construct(array $parameters) {
    $this->parameters = $parameters;
  }

  /**
   * {@inheritdocs}
   */
  public function initializeContext(Context $context) {

    // All contexts are passed here, only DrupalAwareInterface is allowed.
    if (!$context instanceof ScreenshotAwareInterface) {
      return;
    }

    // Add all parameters to the context.
    $context->setScreenshotParameters($this->parameters);
  }

}
