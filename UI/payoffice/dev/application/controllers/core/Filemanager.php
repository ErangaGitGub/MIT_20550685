<?php
/**
* Class:  Filemanager Controller 
* Author: Eranga
* Date:   29/10/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/core/'.'Base.php');

class Filemanager extends Base {

    public function show_file_list()
    { 
    	if ($this->config->item('allow_msg_testing')) {
    		print_r('<h1>LIST OF FIN MESSAGES:</h1>');

	    	$path=$this->config->item('msg_dir');

	    	$file_path=$this->config->item('base_url')."test/finmessages/download?file=";

	    	if ($handle = opendir($path)) {
	    	print_r('<ul>');  	
		    while (false !== ($file = readdir($handle))) {
		      if ($file != "." && $file != "..") {
		        print_r('<li><a href="'.$file_path.$file.'">'.$file.'</a></li>');
		      }
		    }
		    print_r('</ul>');
		    closedir($handle);
		  	}
    	}     	
    }

    public function download()
    {
    	if ($this->config->item('allow_msg_testing')) {

	    	$file = basename($_GET['file']);
			$file = $this->config->item('msg_dir').$file;

			if(!file_exists($file)){ // file does not exist
			    die('file not found');
			} else {
			    header("Cache-Control: public");
			    header("Content-Description: File Transfer");
			    header("Content-Disposition: attachment; filename=$file");
			    header("Content-Type: application/zip");
			    header("Content-Transfer-Encoding: binary");

			    // read the file from disk
			    readfile($file);
			}
		}
    }
}