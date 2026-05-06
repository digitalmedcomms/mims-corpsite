<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePageVisitsTable extends Migration
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
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'referrer' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('page_visits');

        // Add menu item
        $this->db->table('user_menu')->insert([
            'menu_category' => 1, // Common Page
            'title'         => 'page_visits',
            'url'           => 'page-visits',
            'icon'          => 'fas fa-chart-line',
            'parent'        => 0,
            'position_order' => 11
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
            'label'       => 'page_visits',
            'translation' => 'Page Visits'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('page_visits');
        
        $this->db->table('user_menu')->where('title', 'page_visits')->delete();
        $this->db->table('language_translations')->where('label', 'page_visits')->delete();
    }
}
