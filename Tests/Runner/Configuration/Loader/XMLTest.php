<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.8.0
 */

/**
 *
 *
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.8.0
 * @covers     PHPUnit_Runner_Configuration_Loader_XML
 */
class Runner_Configuration_Loader_XMLTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Runner_Configuration
     */
    private $configuration;

    /**
     * @var PHPUnit_Runner_Configuration_Loader_XML
     */
    private $loader;

    protected function setUp()
    {
        $this->configuration = PHPUnit_Runner_Configuration::getInstance();
        $this->loader        = new PHPUnit_Runner_Configuration_Loader_XML;
    }

    /**
     * @backupStaticAttributes enabled
     */
    public function testConfigurationCanBeLoadedFromXMLFile()
    {
        $this->loader->load(
          $this->configuration,
          __DIR__ . '/../../../_files/configuration.xml'
        );

        $this->assertTrue($this->configuration->getAddUncoveredFilesFromWhitelist());
        $this->assertTrue($this->configuration->getProcessUncoveredFilesFromWhitelist());

        $this->assertEquals(
          array(
            'include' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            ),
            'exclude' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            )
          ),
          $this->configuration->getBlacklist()
        );

        $this->assertEquals(
          array(
            'include' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            ),
            'exclude' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            )
          ),
          $this->configuration->getWhitelist()
        );
    }
}