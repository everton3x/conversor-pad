<?php
namespace CPAD;

/**
 * Utilidades gerais
 *
 * @author Everton
 */
class Utils
{
    /**
     * Formata uma string de acordo com uma máscara.
     * 
     * Se a string fornecida em $data for maior que a contagem de # em $mask, os caracteres que ultrapassem o comrimento dos # será descartada.
     * 
     * @param string $data
     * @param string $mask Máscara sendo que o caractere # é o curinga.
     * @return string
     */
    public static function applyMask(string $data, string $mask): string
    {
        $masked = '';
        $charIndex = 0;
        foreach (str_split($mask, 1) as $v) {
            if ($v === '#') {
                $masked .= $data[$charIndex];
                $charIndex++;
            }else{
                $masked .= $v;
            }
        }
        
        return $masked;
    }
    
    /**
     * Desloca todos os ZEROS que estão à esquerda, para a direita.
     * 
     * @param string $data
     * @return string
     */
    public static function deslocZerosToRight(string $data): string
    {
        $desloc = '';
        $control = false;
        
        foreach (str_split($data, 1) as $v){
            settype($v, 'string');
            if($v === '0'){
                if(!$control){
                    continue;
                }
                $desloc .= $v;
            }else{
                $desloc .= $v;
                $control = true;
            }
        }
        
        
        return str_pad($desloc, strlen($data), "0", STR_PAD_RIGHT);
    }
}
