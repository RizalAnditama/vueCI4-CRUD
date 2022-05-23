<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Product extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        if (!$data) return $this->failNotFound('No data found');

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->find(['id' => $id]);
        if (!$data) return $this->failNotFound('No data found');

        return $this->respond($data[0], 200);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new ProductModel();
        $json = $this->request->getJSON();
        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'price' => $json->price,
        ];

        $product = $model->insert($data);
        if (!$product) return $this->fail('Fail to create data', 400);

        return $this->respondCreated($product);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new ProductModel();
        $json = $this->request->getJSON();
        $data = [
            'name' => $json->name,
            'description' => $json->description,
            'price' => $json->price,
        ];

        $checkId = $model->find(['id' => $id]);
        if (!$checkId) return $this->failNotFound('No data found');

        $product = $model->update($id, $data);
        if (!$product) return $this->fail('Fail to update data', 400);

        return $this->respondUpdated($product);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $product = $model->delete($id);
        if (!$product) return $this->fail('Fail to delete data', 400);

        return $this->respondDeleted($product);
    }
}
