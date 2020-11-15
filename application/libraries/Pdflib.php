<?php
/**
* 
*/
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdflib extends Dompdf
{
  
  	private $ci;

  	function __construct()
  	{
    	parent::__construct();
    	$this->ci = &get_instance();
  	}

  	protected function render_html($content)
  	{

    	$this->loadHtml($content);
    	$this->setPaper('A4');
    	// Render the HTML as PDF
    	$this->render();
    	// Output the generated PDF to Browser
    	$this->stream("dompdf_".time().".pdf", array("Attachment" => false,'isRemoteEnabled' => true));
    	//$this->Output([]);
    	exit(0);
  	}
  	public function render_from_page($view,$data=array())
  	{
      	$page = $this->ci->load->view($view,$data,true);
    	$this->render_html($page);
  	}
  
}