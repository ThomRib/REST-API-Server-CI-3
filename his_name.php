  <?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . '/libraries/REST_Controller.php';
    use Restserver\Libraries\REST_Controller;

    class his_name extends REST_Controller {
                                           function __construct($config = 'rest') {
                                             parent::__construct($config);
                                             $this->load->database();
                                           }
										   
                                          // location function
                                          // Get
                                          function index_get() {
																   $id = $this->get('id');
																   if ($id == '') {
																	 $his_name = $this->db->get('list_name')->result();
																   } else {
																	 $this->db->where('id', $id);
																	 $his_name = $this->db->get('list_name')->result();
																   }
																   $this->response($his_name, 200);
											 }
											 
										  // Post
										  function index_post() {
																   $data = array(
																				 'id' => $this->post('id'),
																				 'nama' => $this->post('nama');
																   $insert = $this->db->insert('list_name', $data);
																   if ($insert) {
																	 $this->response($data, 200);
																   } else {
																	 $this->response(array('status' => 'fail', 502));
																   }
											 }
											 
                                          // Put
										  function index_put() {
																 $id = $this->put('id');
																 $data = array(
																			 'id' => $this->put('id'),
																			 'nama' => $this->put('nama');
																 $this->db->where('id', $id);
																 $update = $this->db->update('list_name', $data);
																 if ($update) {
																   $this->response($data, 200);
																 } else {
																   $this->response(array('status' => 'fail', 502));
																 }
											 }
											 
                                          // Delete
										  function index_delete() {
																	 $id = $this->delete('id');
																	 $this->db->where('id', $id);
																	 $delete = $this->db->delete('list_name');
																	 if ($delete) {
																	   $this->response(array('status' => 'success'), 201);
																	 } else {
																	   $this->response(array('status' => 'fail', 502));
																	 }
											 }
                                          }
    ?>