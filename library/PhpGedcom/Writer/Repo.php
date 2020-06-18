<?php
/**
 * php-gedcom
 *
 * php-gedcom is a library for parsing, manipulating, importing and exporting
 * GEDCOM 5.5 files in PHP 5.3+.
 *
 * @author          Xiang Ming <wenqiangliu344@gmail.com>
 * @copyright       Copyright (c) 2010-2013, Xiang Ming
 * @package         php-gedcom 
 * @license         GPL-3.0
 * @link            http://github.com/mrkrstphr/php-gedcom
 */

namespace PhpGedcom\Writer;

/**
 *
 */
class Repo
{
    /**
     * @param \PhpGedcom\Record\Repo $sour
     * @param int $level
     * @return string
     */
    public static function convert(\PhpGedcom\Record\Repo &$repo)
    {
        $level = 0;
        $output = "";
        $_repo = $repo->getRepo();
        if($_repo){
            $output.=$level." ".$id." REPO\n";
        }else{
            return $output;
        }

        // level up
        $level++;

        //NAME
        $name = $repo->getName();
        if($name){
            $output.=$level." NAME ".$name."\n";
        }

        // ADDR 
        $addr = $repo->getAddr();
        if($addr){
            $_convert = \PhpGedcom\Writer\Addr::convert($addr, $level);
            $output.=$_convert;
        }

        // PHON
        $phon = $repo->getPhon();
        if($phon){
            $_convert = \PhpGedcom\Writer\Phon::convert($phon, $level);
            $output.=$_convert;
        }

        // NOTE array
        $note = $repo->getNote();
        if($note && count($note) > 0) {
            foreach($note as $item){
                if($item){
                    $_convert = \PhpGedcom\Writer\NoteRef::convert($item, $level);
                    $output.=$_convert;
                }
            }
        }

        // REFN
        $refn = $repo->getRefn();
        if(!empty($refn) && count($refn) > 0) {
            foreach($refn as $item){
                if($item){
                    $_convert = \PhpGedcom\Writer\Refn::convert($item, $level);
                    $output.=$_convert;
                }
            }
        }

        // CHAN
        $chan = $repo->getChan();
        if($chan){
            $_convert = \PhpGedcom\Writer\Chan::convert($chan, $level);
            $output.=$_convert;
        }

        // RIN
        $rin = $repo->getRin();
        if($rin){
            $output.=$level." RIN ".$rin."\n";
        }
        return $output;
    }
}