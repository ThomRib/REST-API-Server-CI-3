# REST-API-Server-CI-3

# 1) Prepare
  - You soud download **library REST Server**, link in below
  ```gitbash
  https://github.com/chriskacerguis/codeigniter-restserver
  ```

# 2) Config
  - Creat new database
    ```sql
    CREATE DATABASE 'his_name';
    ```
  - Creat new table
    ```sql
    USE name;
    CREATE TABLE IF NOT EXISTS `list_name` (
                                           `id` int(11) NOT NULL AUTO_INCREMENT,
                                           `nama` varchar(50) NOT NULL,
                                           PRIMARY KEY (`id`)
                                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;
    ```
  - Input example data
    ```sql
    USE kontak;
    INSERT INTO `list_name` (`id`, `nama`) VALUES
                            (1, 'thomas'),
                            (2, 'yuda');
    ```
  - Open file **database.php** location in your codeigniter
    for example
    ```
    REST-API-Server-CI-3/application/config/database.php
    ```
  - You can change, as example **in database.php**
    ```php
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $active_group = 'default';
    $query_builder = TRUE;
    $db['default'] = array(
                            'dsn' => '',
                            'hostname' => 'localhost',
                            'username' => 'root',
                            'password' => '',
                            'database' => 'his_name',
                            'dbdriver' => 'mysqli',
                            'dbprefix' => '',
                            'pconnect' => FALSE,
                            'db_debug' => (ENVIRONMENT !== 'production'),
                            'cache_on' => FALSE,
                            'cachedir' => '',
                            'char_set' => 'utf8',
                            'dbcollat' => 'utf8_general_ci',
                            'swap_pre' => '',
                            'encrypt' => FALSE,
                            'compress' => FALSE,
                            'stricton' => FALSE,
                            'failover' => array(),
                            'save_queries' => TRUE
                          );
    ```
    
# 3) location
  - Creat new file in **REST-API-Server-CI-3/application/controller**
    for example
    ```
    rest_ci/application/controller/his_name.php
    ```
  - copy file in below to **his_name.php**
    ```php
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
                                          // Post
                                          // Put
                                          // Delete
                                          }
    ?>
    ```
    
# 4) function Get
    - copy Get function
    ```php
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
    ```
    
# 5) function Post
    - copy Post function
    ```php
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
    ```
    
# 6) function Put
    - copy Put function
    ```php
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
    ```
    
# 7) function Delete
    - copy Delete function
    ```php
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
    ```
