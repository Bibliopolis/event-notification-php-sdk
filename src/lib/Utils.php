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

namespace EventNotificationPHPSdk\lib;

use EventNotificationPHPSdk\lib\Constants;

class Utils
{
	private $constants;
	private $cache;

	function __construct($cache)
	{
		$this->cache = $cache;
		$this->constants = new Constants();
	}

	public function getEndpoint($endpoint, $environment)
	{
		$notificationApiEndpoint = sprintf($environment === $this->constants::ENVIRONMENT['SANDBOX'] ?
			$this->constants::NOTIFICATION_ENDPOINT_SANDBOX :
			$this->constants::NOTIFICATION_API_ENDPOINT_PRODUCTION, $this->constants::VERSION, $endpoint);
	}

	public function appendEndpoint($endpoint, $params)
	{
		if (empty($params))
			return $endpoint;
		$notificationApiEndpoint = $endpoint;
		$notificationApiEndpoint .= '?';
		foreach ($params as $key => $value) {
			$notificationApiEndpoint .= $key . '=' . $value . '&';
		}
		return $notificationApiEndpoint;
	}

	public function processCache($cacheId)
	{
		$$cacheId = $this->cache->get($cacheId);
		if ($$cacheId !== null) {
			return $$cacheId;
		}
	}
}