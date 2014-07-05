<?php
require_once(dirname(__FILE__).'/../../../../init.php');

class XoopsObjectTestInstance extends Xoops\Core\Kernel\XoopsObject
{
}

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class XoopsObjectTest extends MY_UnitTestCase
{
	protected $myClass = 'XoopsObjectTestInstance';
    
    public function test___construct()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
    }
	
    public function test___constants()
	{
		$this->assertTrue(defined('XOBJ_DTYPE_TXTBOX'));
		$this->assertTrue(defined('XOBJ_DTYPE_TXTAREA'));
		$this->assertTrue(defined('XOBJ_DTYPE_INT'));
		$this->assertTrue(defined('XOBJ_DTYPE_URL'));
		$this->assertTrue(defined('XOBJ_DTYPE_EMAIL'));
		$this->assertTrue(defined('XOBJ_DTYPE_ARRAY'));
		$this->assertTrue(defined('XOBJ_DTYPE_OTHER'));
		$this->assertTrue(defined('XOBJ_DTYPE_SOURCE'));
		$this->assertTrue(defined('XOBJ_DTYPE_STIME'));
		$this->assertTrue(defined('XOBJ_DTYPE_MTIME'));
		$this->assertTrue(defined('XOBJ_DTYPE_LTIME'));
		$this->assertTrue(defined('XOBJ_DTYPE_FLOAT'));
		$this->assertTrue(defined('XOBJ_DTYPE_DECIMAL'));
		$this->assertTrue(defined('XOBJ_DTYPE_ENUM'));
		
    }
	
    public function test___publicProperties()
	{
		$items = array('vars', 'cleanVars','plugin_path');
		foreach($items as $item) {
			$prop = new ReflectionProperty($this->myClass,$item);
			$this->assertTrue($prop->isPublic());
		}
    }
	
	
    public function test_setNew()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
		$instance->setNew();
		$this->assertTrue($instance->isNew());
		$instance->unsetNew();
		$this->assertFalse($instance->isNew());
		$instance->setNew();
		$this->assertTrue($instance->isNew());		
    }
	
    public function test_unsetNew()
	{
		// see setNew
    }
	
    public function test_isNew()
	{
		// see setNew
    }
	
    public function test_setDirty()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
		$instance->setDirty();
		$this->assertTrue($instance->isDirty());
		$instance->unsetDirty();
		$this->assertFalse($instance->isDirty());
		$instance->setDirty();
		$this->assertTrue($instance->isDirty());		
    }
	
    public function test_unsetDirty()
	{
		// see setDirty
    }
	
    public function test_isDirty()
	{
		// see setDirty
    }
	
    public function test_initVar()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
		
		$key = 'key';
		$data_type = XOBJ_DTYPE_TXTBOX;
		$value = 'value';
		$required = true;
		$maxlength = 10;
		$options = 'options';
		$instance->initVar($key, $data_type, $value, $required, $maxlength, $options);
		$vars = $instance->vars;
		
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == $value);
		$this->assertTrue($vars[$key]['data_type'] == $data_type);
		$this->assertTrue($vars[$key]['required'] == $required);
		$this->assertTrue($vars[$key]['maxlength'] == $maxlength);
		$this->assertTrue($vars[$key]['options'] == $options);
		$this->assertTrue($vars[$key]['changed'] == false);
		
		$instance->initVar($key, $data_type);
		$vars = $instance->vars;
		
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == null);
		$this->assertTrue($vars[$key]['data_type'] == $data_type);
		$this->assertTrue($vars[$key]['required'] == false);
		$this->assertTrue($vars[$key]['maxlength'] == null);
		$this->assertTrue($vars[$key]['options'] == '');
		$this->assertTrue($vars[$key]['changed'] == false);
    }
	
	public function test_assignVar()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
		
		$key = 'key';
		$data_type = XOBJ_DTYPE_TXTBOX;
		$instance->initVar($key, $data_type);
		$vars = $instance->vars;
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == null);
		
		$value = 'value';
		$instance->assignVar($key, $value);
		$vars = $instance->vars;
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == $value);
    }
	
	public function test_assignVars()
	{
        $instance = new $this->myClass();
        $this->assertInstanceOf($this->myClass, $instance);
		
		$key = 'key1';
		$data_type = XOBJ_DTYPE_TXTBOX;
		$instance->initVar($key, $data_type);
		$vars = $instance->vars;
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == null);
		
		$key = 'key2';
		$data_type = XOBJ_DTYPE_TXTBOX;
		$instance->initVar($key, $data_type);
		$vars = $instance->vars;
		$this->assertTrue(is_array($vars));
		$this->assertTrue($vars[$key]['value'] == null);
		
		$arrVars = array('key1' => 'value1', 'key2' => 'value2');
		$instance->assignVars($arrVars);
		$vars = $instance->vars;
		$this->assertTrue(is_array($vars));
		foreach ($arrVars as $k => $v) {
			$this->assertTrue($vars[$k]['value'] == $v);
		}
    }
	
	public function test_setVar()
	{
		$instance = new $this->myClass();
		$instance->initVar('dummyVar', XOBJ_DTYPE_INT, 0);
		$value = &$instance->vars['dummyVar'];
		$this->assertSame(0, $value['value']);
		
		$instance->setVar('dummyVar', 1);
		$this->assertSame(1, $value['value']);
		$this->assertTrue($instance->isDirty());
		
		$instance->setVar(null, 2);
		$this->assertSame(1, $value['value']);
		
		$instance->setVar('dummyVar', null);
		$this->assertSame(1, $value['value']);
		
		$instance->setVar('dummyVar', 3, true);
		$this->assertSame(3, $value['value']);
		$this->assertSame(true, $value['not_gpc']);
    }
	
	public function test_setVars()
	{
		$instance = new $this->myClass();
		$instance->initVar('dummyVar1', XOBJ_DTYPE_INT, 0);
		$instance->initVar('dummyVar2', XOBJ_DTYPE_INT, 0);
		$instance->initVar('dummyVar3', XOBJ_DTYPE_INT, 0);
		
		$instance->setVars(array(
			'dummyVar1' => 1,
			'dummyVar2' => 2,
			'dummyVar3' => 3
		));
		
		$this->assertSame(1, $instance->vars['dummyVar1']['value']);
		$this->assertSame(false, $instance->vars['dummyVar1']['not_gpc']);
		$this->assertSame(2, $instance->vars['dummyVar2']['value']);
		$this->assertSame(false, $instance->vars['dummyVar2']['not_gpc']);
		$this->assertSame(3, $instance->vars['dummyVar3']['value']);
		$this->assertSame(false, $instance->vars['dummyVar2']['not_gpc']);
		
		$instance->setVars(array(
			'dummyVar1' => 11,
			'dummyVar2' => 22,
			'dummyVar3' => 33
		), true);
		
		$this->assertSame(11, $instance->vars['dummyVar1']['value']);
		$this->assertSame(true, $instance->vars['dummyVar1']['not_gpc']);
		$this->assertSame(22, $instance->vars['dummyVar2']['value']);
		$this->assertSame(true, $instance->vars['dummyVar2']['not_gpc']);
		$this->assertSame(33, $instance->vars['dummyVar3']['value']);
		$this->assertSame(true, $instance->vars['dummyVar2']['not_gpc']);

    }
	
	public function test_destroyVars()
	{
		$this->markTestIncomplete();
    }
	
	public function test_setFormVars()
	{
		$this->markTestIncomplete();
    }
	
	public function test_getVars()
	{
		$this->markTestIncomplete();
    }
	
	public function test_getValues()
	{
		$this->markTestIncomplete();
    }
	
	public function test_getVar()
	{
		$this->markTestIncomplete();
    }
	
	public function test_cleanVars()
	{
		$this->markTestIncomplete();
    }
	
	public function test_registerFilter()
	{
		$this->markTestIncomplete();
    }
	
	public function test_loadFilters()
	{
		$this->markTestIncomplete();
    }
	
	public function test_xoopsClone()
	{
		$this->markTestIncomplete();
    }
	
	public function test_setErrors()
	{
		$this->markTestIncomplete();
    }
	
	public function test_getErrors()
	{
		$this->markTestIncomplete();
    }
	
	public function test_getHtmlErrors()
	{
		$this->markTestIncomplete();
    }
	
	public function test_toArray()
	{
		$this->markTestIncomplete();
    }
	
}
