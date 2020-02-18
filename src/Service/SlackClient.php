<?php

namespace App\Service;

use Nexy\Slack\Client;
use App\Helper\LoggerTrait;

class SlackClient
{
    use LoggerTrait;
    /**
     * @var
     */
    private $slack;

    /**
     * SlackClient constructor.
     * @param Client $slack
     */
    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Sending a message to Slack via LoggerTraitg!', [
            'message' => $message
        ]);

        $slackMessage = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($slackMessage);
    }
}