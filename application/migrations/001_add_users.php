<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'user_pword' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'user_first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
            ),
            'user_last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
            ),
            'user_image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'user_auth_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'user_authorized' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => '0'                
            ),
            'user_status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => '1'
            )
        ));

        $this->dbforge->add_field("user_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("user_type ENUM('admin', 'teacher', 'parent', 'student') NULL");

        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
