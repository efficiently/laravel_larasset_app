<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    /**
     * Always accept JavaScript popup.
     * Workaround to `$I->acceptPopup();`
     * Because this method doesn't work with PhantomJS
     *
     * Source: https://github.com/detro/ghostdriver/issues/20#issuecomment-44032604
     *
     * @return \AcceptanceTester $I
     */
    public function alwaysAcceptPopup()
    {
        $I = $this->getAcceptanceModule();
        // Accept Popup
        $I->executeJS("window.alert = function(msg){};");//JS

        // Confirm Popup
        $I->executeJS("window.confirm = function(msg){return true;};");//JS

        return $I;
    }

    /**
     * Wait for all AJAX requests to finish.
     *
     * Executes JavaScript and waits up to $timeout seconds for it to return true.
     * By default, we will wait up to 5 seconds for all jQuery AJAX requests to finish.
     *
     * Source: http://codeception.com/docs/modules/WebDriver#waitForJS
     *
     * @param string $javascript
     * @param int    $timeout seconds
     *
     * @return \AcceptanceTester $I
     */
    public function waitForAjax($javascript = 'return jQuery.active == 0;', $timeout = 5)
    {
        $javascript = $javascript ?: 'return jQuery.active == 0;';
        $I = $this->getAcceptanceModule();
        $this->waitForDOMReady($timeout);//test
        $I->waitForJS($javascript, $timeout);

        return $I;
    }

    /**
     * Wait for DOM and jQuery are ready to use.
     *
     * @param int $timeout seconds
     *
     * @return \AcceptanceTester $I
     */
    public function waitForDOMReady($timeout = 5)
    {
        $I = $this->getAcceptanceModule();
        $javascript = 'return typeof jQuery !== "undefined" && jQuery && jQuery.isReady;';

        return $this->hasModule('WebDriver') ? $I->waitForJS($javascript, $timeout): $I;
    }

    /**
     * Wait for all Turbolinks requests to finish via jQuery Turbolinks plugin.
     *
     * Executes JavaScript and waits up to $timeout seconds for it to return true.
     * It will wait up to 5 seconds for all Turbolinks AJAX requests to finish.
     *
     * @param int $timeout seconds
     *
     * @return \AcceptanceTester $I
     */
    public function waitForTurbolinks($timeout = 5)
    {
        $I = $this->getAcceptanceModule();

        $javascript = <<<EOT
var result = true; // Returns true if Turbolinks or jQuery Turbolinks are missing
if (
    typeof Turbolinks !== 'undefined' && Turbolinks.supported &&
    typeof jQuery !== 'undefined' && jQuery.turbo
) {
    result = jQuery.turbo.isReady;
}
return result;
EOT;
        return $this->hasModule('WebDriver') ? $this->waitForAjax($javascript, $timeout): $I;
    }

    /**
     * Override $I->click() method to support `Turbolinks.visit()`
     *
     * @param $link
     * @param $context
     * @param array $options
     *                'timeout' option: seconds, default to 5
     *                'noTurbolink' option: flag to skip Turbolinks waiting, default to false
     */
    public function click($link, $context = null, $options = [])
    {
        $options = array_merge(['timeout' => 5, 'noTurbolink' => false], $options);
        $I = $this->getAcceptanceModule();

        $this->waitForDOMReady($options['timeout']);//test

        $I->click($link, $context);

        if ($this->hasModule('WebDriver') && $options['noTurbolink'] == false) {
            $I = $this->waitForTurbolinks($options['timeout']);
            $I = $this->waitForAjax(null, $options['timeout']);
        }
    }

    public function amOnPage($page, $options = [])
    {
        $options = array_merge(['timeout' => 5], $options);
        $I = $this->getAcceptanceModule();

        $I->amOnPage($page);
        $this->waitForDOMReady($options['timeout']);//test
    }

    protected function getAcceptanceModule()
    {
        return $this->hasModule('WebDriver') ? $this->getModule('WebDriver') : $this->getModule('PhpBrowser');
    }
}
