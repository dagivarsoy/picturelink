<?php
/**
 * Created by PhpStorm.
 * User: Dag
 * Date: 08/06/2015
 * Time: 12:39
 */

namespace Divarsoy\Picturelink;

class Picturelink {

    /**
     * Creates a Picturelink with srcsets
     * @param string $url
     * @param array $sizes
     * @param array $options
     * @param string $alt
     * @param array $attributes
     * @return string
     */
    public function makeLink($url, array $sizes = array(), array $options = array(), $attributes = array(), $alt = null){
        $returnString = '';
        $returnString .= $this->makePictureStartTag($attributes);
        $returnString .= $this->makeIEfixStart();
        $returnString .= $this->makeSource($url, $sizes, $options);
        $returnString .= $this->makeIEfixEnd();
        $returnString .= $this->makeFallback($url, $sizes, $alt);
        $returnString .= $this->makePictureEndTag();
        return $returnString;
    }

    /**
     * Creates a <Picture> tag with attributes
     *
     * @param array $attributes
     * @return string
     */
    protected function makePictureStartTag($attributes = array())
    {
        return "<picture".$this->attributes($attributes). ">".PHP_EOL;
    }

    /**
     * Creates a </picture> tag
     *
     * @return string
     */
    protected function makePictureEndTag()
    {
        return "</picture>".PHP_EOL;
    }

    /**
     * Creates a workaround for IE9
     *
     * @return string
     */
    protected function makeIEfixStart()
    {
        return '<!--[if IE 9]><video style="display: none;"><![endif]-->'.PHP_EOL;
    }

    /**
     * Creates an endtag for the IE9 workaround
     *
     * @return string
     */
    protected function makeIEfixEnd()
    {
        return '<!--[if IE 9]></video><![endif]-->'.PHP_EOL;
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param  array  $attributes
     * @return string
     */
    protected function attributes($attributes)
    {
        if (!empty($attributes)) {
            $returnString = ' ';

            foreach ($attributes as $key => $value) {
                $returnString .= $key . '="' . $value . '" ';
            }
            return $returnString;
        }
    }

    /**
     * Gets the extension part from an url to an image
     *
     * @param string $url
     * @return string
     */
    protected function getExtension($url){
        return pathinfo($url, PATHINFO_EXTENSION);
    }

    /**
     * Gets the url without the extension
     *
     * @param string $url
     * @return string
     */
    protected function removeExtension($url){
        $path = pathinfo($url);
        return $path['dirname'].'/'.$path['filename'];
    }

    /**
     * Makes the Srcsets from the $sizes array.
     *
     * @param string $url
     * @param array $sizes
     * @param array $option
     * @return string
     */
    protected function makeSource($url, array $sizes, array $option){
        $returnString = '';
        sort($sizes, SORT_NUMERIC);

        if (count($sizes) == 1){
            $this->checkIfNumber($sizes[0]);
            $returnString .= '<source media="(max-width: ' . $sizes[0] . 'px)" ';
            $returnString .= 'srcset="' . $this->removeExtension($url) . $sizes[0] . '.' . $this->getExtension($url);
            $returnString .= $this->makeHighResolutionLinks($url, $sizes[0], $option);
            $returnString .= '" />';
            return $returnString.PHP_EOL;
        }

        for($i=0; $i < count($sizes) - 1; $i++ ) {
            $this->checkIfNumber($sizes[$i]);
            $returnString .= '<source media="(max-width: ' . $sizes[$i] . 'px)" ';
            $returnString .= 'srcset="' . $this->removeExtension($url) . $sizes[$i] . '.' . $this->getExtension($url);
            $returnString .= $this->makeHighResolutionLinks($url, $sizes[$i], $option);
            $returnString .= '" />'.PHP_EOL;
        }
        if (count($sizes) > 2) {
            $lastSize = $sizes[count($sizes) - 1];
            $nextToLastSize = $sizes[count($sizes) - 2];
            $this->checkIfNumber($lastSize);

            $returnString .= '<source media="(min-width: ' . $nextToLastSize . 'px)" ';
            $returnString .= 'srcset="' . $this->removeExtension($url) . $lastSize . '.' . $this->getExtension($url);
            $returnString .= $this->makeHighResolutionLinks($url, $lastSize, $option);
            $returnString .= '" />';
            return $returnString.PHP_EOL;
        }
        return $returnString.PHP_EOL;
    }

    /**
     * Checks that the size specified is a number
     * @param $number
     */
    protected function checkIfNumber($number){
        if(! is_numeric($number)){
            throw new \InvalidArgumentException(
                'Size array must only consist of numbers'
            );
        }
    }

    /**
     * Makes @2x srcsets if set in options
     *
     * @param string $url
     * @param int $size
     * @param array $options
     * @return string
     */
    protected function makeHighResolutionLinks($url, $size, array $options){
        $returnString = '';
        if (isset($options['resolution'])){
            if( is_array($options['resolution'])) {
                foreach ($options['resolution'] as $resolution) {
                    $returnString .= ', ' . $this->removeExtension($url) . $size . '@' . $resolution . '.' . $this->getExtension($url) . ' ' . $resolution;
                }
                return $returnString;
            }
            else {
                return ', ' . $this->removeExtension($url) . $size . '@' . $options['resolution'] . '.' . $this->getExtension($url) . ' ' . $options['resolution'];
            }
        }
        else {
            return '';
        }
    }

    /**
     * Makes image fallback
     *
     * @param string $url
     * @param array $sizes
     * @param string $alt
     * @return string
     */
    protected function makeFallback($url, array $sizes, $alt = null){
        sort($sizes);
        if(!empty($sizes)) {
            $returnString = '<img src="' . $this->removeExtension($url) . $sizes[count($sizes) - 1] . '.' . $this->getExtension($url) . '" ';

            if (isset($alt)) {
                $returnString .= 'alt="' . $alt . '" ';
            }
            $returnString .= '/>';

            return $returnString . PHP_EOL;
        }
    }
}