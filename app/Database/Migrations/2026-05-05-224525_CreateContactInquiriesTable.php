<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactInquiriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'organisation' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email_recipient' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contact_inquiries');

        // Add menu item
        $this->db->table('user_menu')->insert([
            'menu_category' => 1, // Common Page
            'title'         => 'contact_inquiries',
            'url'           => 'contact-inquiries',
            'icon'          => 'fas fa-envelope',
            'parent'        => 0,
            'position_order' => 10
        ]);
        $menuId = $this->db->insertID();

        // Give access to super admin (role 1)
        $this->db->table('user_access')->insert([
            'role_id' => 1,
            'menu_id' => $menuId
        ]);

        // Add translation
        $this->db->table('language_translations')->insert([
            'lang_id'     => 1, // English
            'label'       => 'contact_inquiries',
            'translation' => 'Contact Inquiries'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('contact_inquiries');
        
        $this->db->table('user_menu')->where('title', 'contact_inquiries')->delete();
        $this->db->table('language_translations')->where('label', 'contact_inquiries')->delete();
    }
}
