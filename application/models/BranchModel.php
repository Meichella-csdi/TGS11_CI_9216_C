<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchModel extends CI_Model
{
    private $table = 'branches';

    public $id;
    public $name;
    public $address;
    public $phoneNumber;
    public $rule = [
        [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required'
        ],
        [
            'field' => 'address',
            'label' => 'address',
            'rules' => 'required'
        ],
        [
            'field' => 'phoneNumber',
            'label' => 'phoneNumber',
            'rules' => 'required|numeric'
        ],
    ];

    public function Rules() { return $this->rule; }

    public function getAll() {
        return $this->db->get('data_mahasiswa')->result();
    }

    public function store($request){
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phoneNumber = $request->phoneNumber;
        
        if($this->db->insert($this->table, $this)){
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }

    public function update($request, $id){
        $updateData = ['name' => $request->name, 'address' => $request->address, 'phoneNumber' => $request->phoneNumber];
        if($this->db->where('id', $id)->update($this->table, $updateData)){
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }

    public function destroy($id){
        if(empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row()))
            return ['msg' => 'Id tidak ditemukan', 'error' => true];

        if($this->db->delete($this->table, array('id' => $id))){
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
}
?>