<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$table_base = "transaction";
		$info = [
			"page_title" => ["Transaksi"],
			"nav_ids" => [$table_base],
			"table_base" => $table_base,
		];

		$this->pageInfo = $info;

		$this->load->model('category_m');
		$this->load->model("{$this->pageInfo['table_base']}_m");
	}

	public function index()
	{
		$this->pageInfo['nav_ids'][] = "{$this->pageInfo['table_base']}_list";
		$this->pageInfo['page_title'][] = "List";
		$this->load->view('home');
	}

	public function create()
	{
		$this->pageInfo['nav_ids'][] = "{$this->pageInfo['table_base']}_create";
		$this->pageInfo['page_title'][] = "Create";
		$this->load->view('home');
	}

}
