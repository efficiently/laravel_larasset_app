<?php
namespace Page;

class Message
{
    /**
     * @var AcceptanceTester
     */
    public $tester;

    protected $id;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    /**
     * @env php
     *
     */
    public function addWithoutJS($I = null)
    {
        $I = $I ?: $this->tester;
        $id = 1;

        $I->amOnPage('/messages');
        $I->see('All messages');
        $I->click('Add a message');
        $I->seeCurrentUrlEquals('/messages/create');
        $I->fillField(['css' => '#create_message [name=title]'], 'Automatic title '.$id);
        $I->fillField(['css' => '#create_message [name=body]'], 'Automatic body '.$id);
        $I->click('Send message', '#create_message');
        $I->seeCurrentUrlEquals('/messages');
        $I->see('Automatic title '.$id, '#message_'.$id);
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     *
     */
    public function add($I = null)
    {
        $I = $I ?: $this->tester;
        $id = $this->id = 1;

        $I->amOnPage('/messages');
        $I->see('All messages');

        $I->click('Add a message');

        $I->waitForElementVisible('form#create_message', 1);

        $I->fillField(['css' => '#create_message [name=title]'], 'Automatic title '.$id);
        $I->fillField(['css' => '#create_message [name=body]'], 'Automatic body '.$id);
        $I->click('Send message', '#create_message');

        $I->waitForElementNotVisible('form#create_message', 1);

        $I->seeCurrentUrlEquals('/messages');// Turbolinks
        $I->see('Automatic title '.$id, '#message_'.$id);
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     *
     */
    public function edit($I = null)
    {
        $I = $I ?: $this->tester;
        $id = $this->id;

        if ($I->grabFromCurrentUrl() !== '/messages') {
            $I->amOnPage('/messages');
        }
        $I->see('All messages');

        $I->click('edit', '#message_'.$id);

        $I->waitForElementVisible('form#message_'.$id, 1);

        $I->seeInField('title', 'Automatic title '.$id);
        $I->seeInField('body', 'Automatic body '.$id);
        $I->fillField(['css' => "#message_$id [name=title]"], 'Edited title '.$id);
        $I->fillField(['css' => "#message_$id [name=body]"], 'Edited body '.$id);
        $I->click('Send message', '#message_'.$id);

        $I->waitForElementNotVisible('form#message_'.$id, 1);

        $I->seeCurrentUrlEquals('/messages');// Turbolinks

        // Wait for Turbolinks response is finished
        $I->waitForElementVisible('div#message_'.$id, 1);

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
    public function destroy($I = null)
    {
        $I = $I ?: $this->tester;
        $id = $this->id;

        if ($I->grabFromCurrentUrl() !== '/messages') {
            $I->amOnPage('/messages');
        }
        $I->see('All messages');
        $I->see('Edited title '.$id, '#message_'.$id);

        $I->alwaysAcceptPopup();// UJS

        $I->click('remove', '#message_'.$id);
        // $I->acceptPopup();// Not compatible with PhantomJS

        // Wait for Turbolinks response is finished
        $I->waitForElementNotVisible('#message_'.$id, 1);

        $I->dontSee('Edited title '.$id);
    }
}
