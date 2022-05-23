<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Product extends Seeder
{
    public function run()
    {
        $data = [
            'name'        => 'Product 1',
            'description' => 'Description 1',
            'price'       => '100',
        ];

        $this->db->table('products')->insert($data);

        $data = [
            'name'        => 'Product 2',
            'description' => 'Description 2',
            'price'       => '200',
        ];

        $this->db->table('products')->insert($data);
    }
}
