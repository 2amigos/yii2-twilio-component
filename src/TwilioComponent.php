<?php

/*
 * This file is part of the 2amigos/yii2-twilio-component project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace dosamigos\twilio;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Client;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class TwilioComponent extends Component
{
    /**
     * @var string your account SID from www.twilio.com/console
     */
    public $sid;
    /**
     * @var string your auth token from www.twilio.com/console
     */
    public $token;
    /**
     * @var string|null a valid twilio number
     */
    public $phoneNumber;
    /**
     * @var Client
     */
    protected $client;

    /**
     * @inheritdoc
     * @throws ConfigurationException If valid authentication is not present
     */
    public function init()
    {
        parent::init();

        $this->client = new Client($this->sid, $this->token);
    }

    /**
     * Sends an SMS using Twilio.
     *
     * @param string $to
     * @param string $text
     * @param array  $options
     *
     * @throws InvalidConfigException
     * @throws ConfigurationException
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function sms(string $to, string $text, array $options = []): MessageInstance
    {
        $from = $options['from']?? null;

        $options = ArrayHelper::merge(
            [
                'from' => $this->parseFrom($from),
                'body' => $text
            ],
            $options
        );

        return $this->client
            ->messages
            ->create($to, $options);
    }

    /**
     * @param $to
     * @param string|null $from
     * @param array       $options
     *
     * @throws InvalidConfigException
     * @return \Twilio\Rest\Api\V2010\Account\CallInstance
     */
    public function call(string $to, string $from = null, array $options = []): CallInstance
    {
        return $this->client
            ->calls
            ->create($to, $this->parseFrom($from), $options);
    }

    /**
     * Returns the internal instance to Twilio's Rest API client.
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Ensures a valid Twilio phone number has been set.
     *
     * @param string|null $from
     *
     * @throws InvalidConfigException
     * @return string
     *
     */
    protected function parseFrom(string $from): string
    {
        if (null === $from) {
            if (null === $this->phoneNumber) {
                throw new InvalidConfigException('A valid Twilio phone number must be set in order to send an SMS.');
            }

            return $this->phoneNumber;
        }

        return $from;
    }
}
