<?php

namespace alex290\treeselect;

use yii\helpers\ArrayHelper;

/**
 * This is just an example.
 */
class TreeSelect extends \yii\base\Model {

    protected function Tree($cattrees, $tab = '') {
        $trees = [];
        $treesChild = [];
        foreach ($cattrees as $treecat) {
            $value = ArrayHelper::getValue($treecat, 'name');
            ArrayHelper::setValue($treecat, 'name', $tab . $value);
            if (!isset($treecat['childs'])) {
                $trees[] = $treecat;
            } else {
                $trees[] = $treecat;
                foreach ($this->Tree($treecat['childs'], '-') as $t)
                    $trees[] = $t;
            }
        }
        return $trees;
    }

    public function getTree($arrayTree) {
        $tree = [];
        $catstree = $arrayTree;
        foreach ($catstree as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $catstree[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        ArrayHelper::multisort($tree, 'weight'); // Сортируем массив по полю weight. Если это необходимо
        $treeOne = ArrayHelper::map($this->Tree($tree), 'id', 'name'); //Вызываем функцию Tree и преобразуем его для select

        return $treeOne;
    }

}
