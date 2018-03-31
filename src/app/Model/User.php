<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class User extends NotORM {

    protected function getTableName($id) {
        return 'user';
    }
    public function getAll(){
        $model=$this->getORM();
        $data=$model->select("*");
         return $data;
    }
    public function getById($id)
    {
        $model=$this->getORM();
        $data=$model->where("id",$id);
        return $data;
    }
    public function deleteById($id) {
        $model = $this->getORM();

        $data = $model->where("id",$id)->delete();
        return $data;
    }
    public function add($insert_data)
    {
        $model=$this->getORM();
        $id=$model->insert($insert_data);
        return $id;
    }
    public function GetIdByName($name)
    {
        $model=$this->getORM();
        $data=$model->where("name",$name);
        return $data;
    }

    public function updateById($id,$data) {
        $model = $this->getORM();

        return $model->where("id", $id)->update($data);
    }
    
    //将base64转为图片 返回布尔
    public function base64toImg($base64, $imgName) {
        $imgName = "user_" . $imgName . '.png';
        if (strstr($base64,",")) {
            $base64 = explode(',',$base64);
            $base64 = $base64[1];
        }

        $img = base64_decode($base64);
        $path = './upload/';
        $a = file_put_contents($path. $imgName, $img);
        if($a)
            return array("filePath"=>$path.$imgName, "fileName"=>$imgName);
        return false;
    }
}