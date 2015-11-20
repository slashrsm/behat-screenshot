# Behat screenshot extension

Imporves screenshots functionality of Behat. Can automatically create screenshots
after failed or all steps.

### Quick start

1. Install using [Composer](https://getcomposer.org/):

    ``` bash
    curl -sS https://getcomposer.org/installer | php
    php composer.phar require slashrsm/behat-screenshot='~1.0'
    ```

1.  In the `behat.yml` add configuration for screenshot extension. Extenstion
    comes with three configuration variables, which are pretty self explanatory:

  ``` yaml
  ...
    extensions:
      slashrsm\screenshot\ScreenshotExtension:
        enabled_always: false
        enabled_on_fail: true
        screenshot_path: '/path/to/screenshots'
  ```

1. In the `behat.yml` add ScreenshotContext to the contexts section:

  ``` yaml
  ...
    contexts:
      ...
      - slashrsm\screenshot\ScreenshotExtension\Context\ScreenshotContext
  ```
