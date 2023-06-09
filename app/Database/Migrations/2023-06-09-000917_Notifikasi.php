<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
{
    public function up()
    {
        $fields = [
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'untuk'                 => ['type' => 'enum', 'constraint' => ['Order', 'Pemesanan', 'Fixing Pemesanan', 'Pembelian', 'Fixing Penjualan'], 'null' => true, 'default' => null],
            'notif'                 => ['type' => 'varchar', 'constraint' => 250, 'null' => true],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('notifikasi', true);
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi');
    }
}