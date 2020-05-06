<?php
namespace zzcms\bot\model;

use think\Model;

class Base extends Model
{
    protected $pk = 'id';
    protected $name = '';
    protected $pre = 'zzcms_';
    protected $is_validate = false;


    static public function getInstance()
    {
        return new static();
    }

    /**
     * 添加
     * @param $data
     * @return bool
     */
    public function addData(array $data)
    {
        $id = $this->isUpdate(false)->allowField(true)->save($data);
        if ($id) {
            return $this->id;
        } else {
            $this->error = '新增失败！';
            return false;
        }
    }

    /**
     * 编辑
     * @param type $data 提交数据
     * @return boolean
     */
    public function editData($data, $id = 0)
    {
        if (empty ($data)) {
            return false;
        }
        $id = $id ? $id : (int)$data[$this->pk];
        if (!$id) {
            $this->error = '参数不能为空！';
            return false;
        }
        $info = $this->get($id);
        if (empty ($info)) {
            $this->error = '信息不存在！';
            return false;
        }
        $data[$this->pk] = $id;
        if (false !== $this->isUpdate(true)->allowField(true)->save($data)) {
            return true;
        } else {
            $this->error = '编辑失败！';
            return false;
        }

    }

    /**
     * 删除
     * 适用于删除单条记录，其他删除请另外方法
     * @param $id
     * @return bool
     */
    public function deleteData($id)
    {
        if (empty ($id)) {
            $this->error = '参数不存在！';
            return false;
        }
        $info = $this->get($id);
        if (empty($info)) {
            $this->error = '信息不存在！';
            return false;
        }
        $num = $this->destroy($id);
        if ($num != 1) {
            $this->error = '删除错误！';
            return false;
        } else {
            return true;
        }
    }

    /**
     * 获取单条记录
     * @param $param 查询条件  可能为数组，也可能为数字（当为数字时视为主键）
     * @return array|bool
     * @throws \think\Exception
     */
    public function getOne($param, $option = [])
    {
        if (empty($param)) {
            return false;
        }
        $order = isset($option['order']) ? $option['order'] : "{$this->pk} desc";
        $field = isset($option['field']) ? $option['field'] : "*";
        $info = null;
        if (is_array($param)) {
            $info = $this->where($param)->field($field)->order($order)->find();
        } else {
            $id = intval($param);
            if ($id > 0) {
                $info = $this->order($order)->field($field)->find($id);
            }
        }
        return empty($info) ? [] : $info->toArray();
    }

}