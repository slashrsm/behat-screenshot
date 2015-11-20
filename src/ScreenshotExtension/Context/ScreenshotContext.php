<?php

namespace slashrsm\screenshot\ScreenshotExtension\Context;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Provides automatic screenshotting capabilities for Behat.
 */
class ScreenshotContext extends RawMinkContext implements ScreenshotAwareInterface {

  /**
   * Screenshot extension parameters.
   *
   * @var array
   */
  protected $parameters;

  /**
   * {@inheritdoc}
   */
  public function setScreenshotParameters(array $parameters) {
    $this->parameters = $parameters;
  }

  /**
   * Optionally (based on config) saves screenshot after every (failed) step.
   *
   * @AfterStep
   */
  public function takeScreenshotAfterFailedStep(AfterStepScope $scope) {
    $after_fail = $this->parameters['enabled_on_fail'];
    $always = $this->parameters['enabled_always'];
    if ($always || ($after_fail && 99 === $scope->getTestResult()->getResultCode())) {
      $filename = date('d-m-y') . '-' . uniqid() . '.png';

      $location = $this->parameters['screenshot_path'];
      $location = $location ? : '/tmp';

      try {
        $screenshot = $this->getSession()->getDriver()->getScreenshot();
        file_put_contents($location . '/' . $filename, $screenshot);
        print 'Screenshot at: ' . $location . '/' . $filename;
      }
      catch (UnsupportedDriverActionException $e) {
        print $e->getMessage();
      }
    }
  }
}
