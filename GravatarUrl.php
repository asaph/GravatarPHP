<?php
/*
 * Copyright 2009 Asaph Engel
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * A class for building Gravatar URLs.
 * 
 * based on rules documented here: http://gravatar.com/site/implement/url
 * 
 * @author Asaph Engel
 */
class GravatarUrl {
	public static $GRAVATAR_URL_PREFIX = "http://www.gravatar.com/avatar/";
	
	public static $DEFAULT_ICON_IDENTICON = "identicon";
	public static $DEFAULT_ICON_MONSTERID = "monsterid";
	public static $DEFAULT_ICON_WAVATAR = "wavatar";
	public static $DEFAULT_ICON_NOT_FOUND = "404";
	
	public static $RATING_G = "g";
	public static $RATING_PG = "pg";
	public static $RATING_R = "r";
	public static $RATING_X = "x";
	
	protected $email;
	protected $size;
	protected $rating;
	protected $defaultIcon;
	
	public function __construct($email, $size=0, $rating=null, $defaultIcon=null) {
		$this->email = $email;
		$this->size = $size;
		$this->rating = $rating;
		$this->defaultIcon = $defaultIcon;
	}

	/**
	 * @return the email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param email the email to set
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return the size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * @param size the size to set
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * @return the rating
	 */
	public function getRating() {
		return $this->rating;
	}

	/**
	 * @param rating the rating to set
	 */
	public function setRating($rating) {
		$this->rating = $rating;
	}

	/**
	 * @return the defaultIcon
	 */
	public function getDefaultIcon() {
		return $this->defaultIcon;
	}

	/**
	 * @param defaultIcon the defaultIcon to set
	 */
	public function setDefaultIcon($defaultIcon) {
		$this->defaultIcon = $defaultIcon;
	}	
	
	public function __toString() {
		$url = self::$GRAVATAR_URL_PREFIX . md5(strtolower($this->email)) . '.jpg';
		$queryString = $this->getQueryString();
		if (!empty($queryString)) {
			$url .= '?' . $queryString;
		}
		return $url;
	}

	protected function getQueryString() {
		$queryString = '';
		if ($this->size > 0) {
			$queryString .= 's=' . $this->size;
		}
		if (!is_null($this->rating)) {
			if (!empty($queryString)) {
				$queryString .= '&';
			}
			$queryString .= 'r=' . $this->rating;
		}
		if (!is_null($this->defaultIcon)) {
			if (!empty($queryString)) {
				$queryString .= '&';
			}
			$queryString .= 'd=' . urlencode($this->defaultIcon);
		}
		return $queryString;
	}
}
?>