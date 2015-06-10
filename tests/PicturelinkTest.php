<?php
/**
 * Created by PhpStorm.
 * User: Dag
 * Date: 08/06/2015
 * Time: 12:39
 */

namespace Divarsoy\Picturelink\Test;
use Divarsoy\Picturelink\Picturelink;

class PicturelinkTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Picturelink
     */
    private $picturelink;

    public function setUp()
    {
        $this->picturelink = new Picturelink();
    }

    public function testMakeLinkReturnsString()
    {
        $this->picturelink = new Picturelink();
        $actual = $this->picturelink->makeLink('/img/mypicture');
        $this->assertInternalType('string', $actual);
    }

    public function testMakeLinkWithOneImage()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);

        $expected = "<picture>".PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes);
        $this->assertStringStartsWith($expected, $actual);
    }
    public function testMakeLinkWithMultipleImages()
    {
        $url = "/img/test.jpg";
        $sizes = array(320, 480, 768, 1024, 1224, 1824);
        $expected = "<picture>".PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 480px)" srcset="/img/test480.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 768px)" srcset="/img/test768.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 1024px)" srcset="/img/test1024.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 1224px)" srcset="/img/test1224.jpg" />'.PHP_EOL;
        $expected .= '<source media="(min-width: 1224px)" srcset="/img/test1824.jpg" />'.PHP_EOL;

        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test1824.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes);
        $this->assertStringStartsWith($expected, $actual);
    }
    public function testMakeLinkWithMultipleImagesRandomOrder()
    {
        $url = "/img/test.jpg";
        $sizes = array(1224, 768, 320, 1824, 480, 1024);
        $expected = "<picture>".PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 480px)" srcset="/img/test480.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 768px)" srcset="/img/test768.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 1024px)" srcset="/img/test1024.jpg" />'.PHP_EOL;
        $expected .= '<source media="(max-width: 1224px)" srcset="/img/test1224.jpg" />'.PHP_EOL;
        $expected .= '<source media="(min-width: 1224px)" srcset="/img/test1824.jpg" />'.PHP_EOL;

        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test1824.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes);
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testMakeLinkWithOneImageAnd2xResolution()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);
        $option = array('resolution' => '2x');

        $expected = "<picture>".PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg, /img/test320@2x.jpg 2x" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes, $option);
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testMakeLinkWithOneImageAndResolutionArray()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);
        $option = array('resolution' => array('2x','3x'));

        $expected = "<picture>".PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg, /img/test320@2x.jpg 2x, /img/test320@3x.jpg 3x" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes, $option);
        $this->assertStringStartsWith($expected, $actual);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMakeLinkWithNonNumbersAsSizes(){
        $url = '/img/test.jpg';
        $sizes = array('A');
        $this->picturelink->makeLink($url, $sizes);
    }

    public function testMakeLinkWithOneAttribute()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);
        $attributes = array('id' => 'testId');

        $expected = '<picture id="testId" >'.PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes, array(), $attributes);
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testMakeLinkWithMultipleAttributes()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);
        $attributes = array('id' => 'testId', 'class' => 'test-class');

        $expected = '<picture id="testId" class="test-class" >'.PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes, array(), $attributes);
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testMakeLinkWithAltTag()
    {
        $url = "/img/test.jpg";
        $sizes = array(320);
        $alt = "test image";

        $expected = '<picture>'.PHP_EOL;
        $expected .= '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
        $expected .= '<source media="(max-width: 320px)" srcset="/img/test320.jpg" />'.PHP_EOL;
        $expected .= '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
        $expected .= '<img src="/img/test320.jpg" alt="test image" />'.PHP_EOL;
        $expected .= '</picture>'.PHP_EOL;

        $actual = $this->picturelink->makeLink($url, $sizes, array(), array(), $alt);
        $this->assertStringStartsWith($expected, $actual);
    }
}
