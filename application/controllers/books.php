<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);  //for testing
	}

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//once they were logged in, i set $this->session->set_userdata['user id'], $user['id'] and $this->session->set_userdata['user alias'], $user['alias']. This is now accessible in session. 
		//after they've logged in properly take them to /books
		$this->load->view("books");

		//get all books
		//$books = $this->book->get_all_books();
		
		//get all reviews

		//get all users


		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}
	public function add()
	{	//this is going to load the add page
		$this->load->view('/add');
	}
	public function book_by_id() //this will process the add book form
	{
		$book_id = $this->book->add($this->input->post()); //save the one value i'm returning so i can pass it to the view to get book by id.
		$book_info = $this->book->get_book_info($book_id);
		$book_reviews = $this->review->get_reviews($book_id);
		
		$book_info[] = $book_reviews;
		$this->load->view("book_by_id", array("book_info" => $book_info));
	}
	public function add_review()
	{
		$this->review->add_review($this->input->post());
		redirect("/books");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */