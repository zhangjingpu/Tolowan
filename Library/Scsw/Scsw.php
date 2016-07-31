<?php
namespace Library\Scsw;

use Library\Scsw\PSCWS4;

class Scsw
{
    /**
     * @param $text string
     * @return array 包含: word 词本身, idf 逆词率(重), off 在text中的偏移, len 长度, attr 词性
     */
    //分词
    public static function scsw($string,$deurl = false)
    {
        if($deurl === true){
            $string = urldecode($string);
        }
        $output = '';
        $pscws = new PSCWS4();
        $pscws->set_charset();
        $pscws->set_dict();
        $pscws->set_rule();
        $pscws->send_text($string);
        while ($some = $pscws->get_result()) {
            foreach ($some as $word) {
                $output = $output . ' ' . $word['word'];
            }
        }
        $pscws->close();
        return $output;
    }
}
