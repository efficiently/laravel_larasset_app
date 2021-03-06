<?php

use \AcceptanceTester;

class MessageCest
{
    protected $id;

    public function _before()
    {
        // $this->truncateTable('messages');
    }

    public function _after()
    {
    }

    // tests

    /**
     * @env php
     *
     */
    public function addMessage(AcceptanceTester $I)
    {
        $id = 1;
        $I->wantTo('add a message');
        $I->amOnPage('/messages');
        $I->see('All messages');
        $I->click('Add a message');
        $I->seeCurrentUrlEquals('/messages/create');
        $I->fillField(['css' => '#create_message [name=title]'], 'Automatic title '.$id);
        $I->fillField(['css' => '#create_message [name=body]'], 'Automatic body '.$id);
        $I->click('Send message', '#create_message');
        $I->seeCurrentUrlEquals('/messages/'.$id);
        $I->see('Automatic title '.$id, '#message_'.$id);
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     *
     */
    public function addMessageWithJS(AcceptanceTester $I)
    {
        $id = $this->id = 1;
        $I->wantTo('add a message');
        $I->amOnPage('/messages');
        $I->see('All messages');

        $I->click('Add a message');
        $I->fillField(['css' => '#create_message [name=title]'], 'Automatic title '.$id);
        $I->fillField(['css' => '#create_message [name=body]'], 'Automatic body '.$id);
        $I->click('Send message', '#create_message');

        $I->seeCurrentUrlEquals('/messages');//UJS
        $I->see('Automatic title '.$id, '#message_'.$id);
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     *
     */
    public function editMessage(AcceptanceTester $I)
    {
        $id = $this->id;
        $I->wantTo('edit a message');
        $I->amOnPage('/messages');
        $I->see('All messages');

        $I->click('edit', '#message_'.$id);
        $I->seeInField('title', 'Automatic title '.$id);
        $I->seeInField('body', 'Automatic body '.$id);
        $I->fillField(['css' => "#edit_message_$id [name=title]"], 'Edited title '.$id);
        $I->fillField(['css' => "#edit_message_$id [name=body]"], 'Edited body '.$id);
        $I->click('Send message', '#edit_message_'.$id);

        $I->seeCurrentUrlEquals('/messages');//UJS
        $I->see('Edited title '.$id, '#message_'.$id);
        $I->see('Edited body '.$id, '#message_'.$id);
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     *
     */
    public function destroyMessage(AcceptanceTester $I)
    {
        $id = $this->id;
        $I->wantTo('destroy a message');
        $I->amOnPage('/messages');
        $I->see('All messages');
        $I->see('Edited title '.$id, '#message_'.$id);

        $this->alwaysAcceptPopup($I);//UJS

        $I->click('remove', '#message_'.$id);
        // $I->acceptPopup();// Not compatible with PhantomJS

        // Wait one second for AJAX requests are finished
        $I->wait(1);

        // $I->dontSeeElement('#message_'.$id); // Too slow, weird ...
        $I->dontSee('Edited title '.$id);
    }

    // helpers

    /**
     * Always accept JavaScript popup.
     * Workaround to `$I->acceptPopup();`
     * Because this method doesn't work with PhantomJS
     *
     * Source: https://github.com/detro/ghostdriver/issues/20#issuecomment-44032604
     *
     * @return \AcceptanceTester $I
     */
    protected function alwaysAcceptPopup(AcceptanceTester $I)
    {
        // Accept Popup
        $I->executeJS("window.alert = function(msg){};");//JS

        // Confirm Popup
        $I->executeJS("window.confirm = function(msg){return true;};");//JS
    }
}
