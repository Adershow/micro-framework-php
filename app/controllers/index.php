<?php
class index
{
    public function domain($data = [])
    {
        var_dump($data);
    }
    public function postTest($data = [])
    {
        echo $data['name'] . '<br/>';
        echo $data['email'];
    }
    public function putTest($data = [])
    {
        var_dump($data);
    }
    public function patchTest($data = [])
    {
        var_dump($data);
    }
    public function deleteTest($data = [])
    {
        var_dump($data);
    }
}
