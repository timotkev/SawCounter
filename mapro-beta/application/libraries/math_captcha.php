<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Math Library For Captcha Login
* Created By : Bramanto
*/

class Math_captcha
{
	private $bil1;
	private $bil2;
	private $operator;
	private $CI;

	public function __construct(){

		$this->CI =& get_instance();			
	}

	function initial()
    {
        //$listoperator = array('+', '-', 'x');
        $listoperator = array('+', 'x');
        $this->bil1 = rand(1, 10);
        $this->bil2 = rand(1, 10);
        
        //$this->operator = $listoperator[rand(0, 2)];
        $this->operator = $listoperator[rand(0, 1)];
    }

    function generate_captcha_math()
    {
        $this->initial();

        if ($this->operator == '+'){

        	$hasil = $this->bil1 + $this->bil2;

        } else if ($this->operator == '-') {

        	$hasil = $this->bil1 - $this->bil2;

        } else if ($this->operator == 'x') {

        	$hasil = $this->bil1 * $this->bil2;
        }
        
        $this->CI->session->set_userdata('captcha_math', $hasil);
    }

    function display_captcha_math()
    {
        return $this->bil1." ".$this->operator." ".$this->bil2." = ? ";
    } 

    function result_captcha_math()
    {
        return $this->CI->session->userdata('captcha_math');
    }
}