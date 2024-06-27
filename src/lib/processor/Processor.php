<?php

/*
 * *
 *  * Copyright 2022 eBay Inc.
 *  *
 *  * Licensed under the Apache License, Version 2.0 (the "License");
 *  * you may not use this file except in compliance with the License.
 *  * You may obtain a copy of the License at
 *  *
 *  *  http://www.apache.org/licenses/LICENSE-2.0
 *  *
 *  * Unless required by applicable law or agreed to in writing, software
 *  * distributed under the License is distributed on an "AS IS" BASIS,
 *  * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  * See the License for the specific language governing permissions and
 *  * limitations under the License.
 *  *
 */

namespace EventNotificationPHPSdk\lib\processor;

use EventNotificationPHPSdk\lib\Constants;
use EventNotificationPHPSdk\lib\processor\AccountDeletionMessageProcessor;
use EventNotificationPHPSdk\lib\processor\BuyerCancelRequestedMessageProcessor;
use EventNotificationPHPSdk\lib\processor\ItemMarkedShippedMessageProcessor;
use EventNotificationPHPSdk\lib\processor\ItemSoldMessageProcessor;
use EventNotificationPHPSdk\lib\processor\ReturnClosedMessageProcessor;

class Processor {
    private $constants;

    function __construct() {
        $this->constants = new Constants();
    }

    /**
     * Get the Processor for the given topic.
     * 
     * @param string $topic
     */
    public function getProcessor($topic) {
        switch ($topic) {
            case $this->constants::TOPICS['BUYER_CANCEL_REQUESTED']:
                return new BuyerCancelRequestedMessageProcessor();
			case $this->constants::TOPICS['ITEM_MARKED_SHIPPED']:
				return new ItemMarkedShippedMessageProcessor();
			case $this->constants::TOPICS['ITEM_SOLD']:
				return new ItemSoldMessageProcessor();
			case $this->constants::TOPICS['MARKETPLACE_ACCOUNT_DELETION']:
				return new AccountDeletionMessageProcessor();
			case $this->constants::TOPICS['RETURN_CLOSED']:
				return new ReturnClosedMessageProcessor();
            default:
                throw new \Exception("Message processor not registered for: " . $topic);
        }
    }
}
