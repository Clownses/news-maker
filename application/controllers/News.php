<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model('news_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function index ($page = 'home') {
		$data['title'] = ucfirst($page);
		$data['isUserLoggedIn'] = $this->session->has_userdata('isUserLoggedIn');

		$config['total_rows'] = $this->news_model->get_total();
    $config['per_page'] = 2;
    $config['uri_segment'] = 1;
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 5;
    $config['base_url'] = base_url(); 

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : 1;
    $data['links'] = $this->pagination->create_links();
    $news = $this->news_model->get_news($config['per_page'], $page);
    foreach ($news as $s) {
			$data['news'][] = [
				'id' => $s->id,
				'title' => $s->title,
				'text' => $s->text,
				'author' => $s->author,
				'image' => $s->image,
				'created_at' => $s->created_at
			];
		}

		$this->load->view('../templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('../templates/footer', $data);
	}

	public function singleNews ($id) {
		$news = $this->news_model->getSingleNews($id);
		$data['title'] = ucfirst($news['title']);
		$data['isUserLoggedIn'] = $this->session->has_userdata('isUserLoggedIn');
		$data['news'] = $news;

		$this->load->view('../templates/header', $data);
		$this->load->view('news/single', $data);
		$this->load->view('../templates/footer', $data);
	}


	public function allNews ($page = 'all news') {
		$data['title'] = ucfirst($page);
		$data['isUserLoggedIn'] = $this->session->has_userdata('isUserLoggedIn');
		$this->load->view('../templates/header', $data);
		$this->load->view('news/all');
		$this->load->view('../templates/footer', $data);
	}

	public function newsList () {
		$data = [];
		$news = $this->news_model->getNews();
		foreach ($news->result() as $s) {
			$data[] = [
				'id' => $s->id,
				'title' => $s->title,
				'text' => $s->text,
				'author' => $s->author,
				'image' => $s->image
			];
		}
		echo json_encode(['draw' => intval($this->input->get('draw')), 'recordsTotal' => $news->num_rows(), 'recordsFiltered' => $news->num_rows(), 'data' => $data]);
	}

	public function createNews () {
		$data = $this->input->post();
		$this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Please enter title']);
    $this->form_validation->set_rules('text', 'Text', 'required', ['required' => 'Please enter text']);

    if($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => 'false', 'msg' => validation_errors()));
    } else {
    	$basepath = 'http://localhost:8888/assets/uploads/';
	    $url = $this->input->post('image');
	    $img = str_replace($basepath, '', $url);
    	$data = [
    		'title'  => $this->input->post('title'),
    		'text'   => $this->input->post('text'),
    		'image'  => $img,
    		'author' => $this->input->post('author'),
    		'id'     => $this->input->post('id')
    	];
    	if($this->input->post('id') > 0) {
    		$insert_id = $this->news_model->update($data);
    	} else {
    		$insert_id = $this->news_model->save($data);
    	}
    	if($insert_id) {
    		echo json_encode(array('status' => 'success', 'msg' => 'Successfull'));
    	} else {
    		echo json_encode(array('status' => 'false', 'msg'   => 'Some errors'));
    	}
    }
	}

	public function removeNews () {
		$id = $this->input->post('newsId');
		if($this->news_model->removeNews($id)) {
			echo json_encode(array('status' => 'success', 'msg' => 'Successfull'));
		} else {
			echo json_encode(array('status' => 'false', 'msg'   => 'Some errors'));
		}
	}
}
