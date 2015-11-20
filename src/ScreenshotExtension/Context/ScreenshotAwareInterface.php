<?php

namespace slashrsm\screenshot\ScreenshotExtension\Context;

use Behat\Behat\Context\Context;

/**
 * Defines screenshot aware context.
 */
interface ScreenshotAwareInterface extends Context {

  /**
   * Sets parameters provided for screenshot extension.
   *
   * @param array $parameters
   */
  public function setScreenshotParameters(array $parameters);

}
