<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$table_base = "category";
		$info = [
			"page_title" => ["Kategori"],
			"nav_ids" => [$table_base],
			"table_base" => $table_base,
		];

		$this->pageInfo = $info;
		$this->post = $this->input->post();

		$this->load->model("{$this->pageInfo['table_base']}_m");
	}

	public function index()
	{
		$this->pageInfo['nav_ids'][] = "{$this->pageInfo['table_base']}_list";
		$this->pageInfo['page_title'][] = "List";
		$this->load->view("{$this->pageInfo['table_base']}/lists");
	}

	public function create()
	{
		$this->pageInfo['nav_ids'][] = "{$this->pageInfo['table_base']}_create";
		$this->pageInfo['page_title'][] = "Create";
		$this->load->view("{$this->pageInfo['table_base']}/create");
	}

	public function get_datatable(){
		$result = $this->category_m->get_data();
		$i = 0;
		foreach ($result['data'] as $key) {
			$table[$i] = $key;
			$table[$i]['action'] = "<a href='".site_url($this->pageInfo['table_base'].'/update/'.$key['category_id'])."' type='button' class='btn btn-update btn-primary'>Update</a>";
			$table[$i]['action'] .= " <button type='button' class='btn btn-delete btn-danger' data-id='{$key['category_id']}'>Delete</button>";

			$i++;
		}
		$datatable = [
			"data" => $table,
			"draw" => $this->post['draw'],
			"recordsTotal" =>$result['total_res'],
			"recordsFiltered" =>$result['total_res'],
		];

		echo json_encode($datatable);
	}

}
