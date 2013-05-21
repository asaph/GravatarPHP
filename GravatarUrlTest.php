<?php
/*
 * Copyright 2009 asaph.org
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

require_once 'PHPUnit/Framework.php';
require_once 'GravatarUrl.php';

/**
 * A PHPUnit test class for GravatarUrl
 * 
 * @author asaph
 */
class GravatarUrlTest extends PHPUnit_Framework_TestCase {

	public function testWithEmailOnly() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com");
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg", $gravatarUrl->__toString());
	}

	public function testWithEmailAndSize() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com");
		$gravatarUrl->setSize(100);
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg?s=100", $gravatarUrl->__toString());
	}	

	public function testWithEmailAndRating() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com");
		$gravatarUrl->setRating(GravatarUrl::$RATING_PG);
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg?r=pg", $gravatarUrl->__toString());
	}	

	public function testWithEmailAndDefaultIconConstant() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com");
		$gravatarUrl->setDefaultIcon(GravatarUrl::$DEFAULT_ICON_IDENTICON);
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg?d=identicon", $gravatarUrl->__toString());
	}	

	public function testWithEmailAndDefaultIconUrl() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com");
		$gravatarUrl->setDefaultIcon("http://example.com/images/example.jpg");
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg?d=http%3A%2F%2Fexample.com%2Fimages%2Fexample.jpg", $gravatarUrl->__toString());
	}

	public function testWithAll() {
		$gravatarUrl = new GravatarUrl("iHaveAn@email.com", 512, GravatarUrl::$RATING_PG, GravatarUrl::$DEFAULT_ICON_IDENTICON);
		$this->assertEquals("http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802.jpg?s=512&r=pg&d=identicon", $gravatarUrl->__toString());
	}
}
?>
