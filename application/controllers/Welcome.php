<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function test(){
		$this->load->library('TextToSpeech');

		$this->texttospeech->setMessage( "Hello world!" );

		// *optional: setting the filename is not required
		$this->texttospeech->createMessage( "hello" );

		// change the output language ("en-US" by default)
		$this->texttospeech->setLanguage( "es-AR" );

		// get the audio file url
		$this->texttospeech->getAudioFile();

		// get the HTML5 audio tag with the audio file
		// *optional: you can pass TRUE for autoplay
		$this->texttospeech->getEmbedAudio();
	}
}
