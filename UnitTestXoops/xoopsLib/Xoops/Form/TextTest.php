<?php
namespace Xoops\Form;

require_once(dirname(__FILE__).'/../../../init_mini.php');

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-08-18 at 21:59:26.
 */
 
/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Text
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Text('Caption', 'name', 10, 20, 'value', 'placeholder');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Xoops\Form\Text::getSize
     */
    public function testGetSize()
    {
        $value = $this->object->getSize();
        $this->assertSame(10, $value);
    }

    /**
     * @covers Xoops\Form\Text::getMaxlength
     */
    public function testGetMaxlength()
    {
        $value = $this->object->getMaxlength();
        $this->assertSame(20, $value);
    }

    /**
     * @covers Xoops\Form\Text::getPlaceholder
     */
    public function testGetPlaceholder()
    {
        $value = $this->object->getPlaceholder();
        $this->assertSame('placeholder', $value);
    }

    /**
     * @covers Xoops\Form\Text::render
     */
    public function testRender()
    {
        $value = $this->object->render();
        $this->assertTrue(is_string($value));
        $this->assertTrue(false !== strpos($value, '<input'));
        $this->assertTrue(false !== strpos($value, 'type="text"'));
        $this->assertTrue(false !== strpos($value, 'name="name"'));
        $this->assertTrue(false !== strpos($value, 'size="10"'));
        $this->assertTrue(false !== strpos($value, 'maxlength="20"'));
        $this->assertTrue(false !== strpos($value, 'placeholder="placeholder"'));
        $this->assertTrue(false !== strpos($value, 'title="Caption"'));
        $this->assertTrue(false !== strpos($value, 'id="name"'));
        $this->assertTrue(false !== strpos($value, 'value="value"'));   
    }
}
