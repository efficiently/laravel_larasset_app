<?php

use \AcceptanceTester;

class MessageCest
{
    /**
     * @var \Page\Message
     */
    protected $page;

    public function _before(AcceptanceTester $I)
    {
        $this->page = $this->page ?: new \Page\Message($I);
    }

    public function _after()
    {
    }

    // tests

    /**
     * @env php
     */
    public function crudWithoutJS()
    {
        $message = $this->page;
        $message->addWithoutJS();
    }

    /**
     * @env chrome
     * @env firefox
     * @env ie
     * @env phantom
     */
    public function crud()
    {
        $message = $this->page;
        $I = $message->tester;

        $I->wantTo('CRUD message resource');

        $I->wantTo('add a message');
        $message->add();

        $I->wantTo('edit a message');
        $message->edit();

        $I->wantTo('destroy a message');
        $message->destroy();
    }
}
