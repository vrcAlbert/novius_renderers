<?php

namespace Novius\Renderers;

class Controller_Admin_HasMany extends \Nos\Controller_Admin_Application
{
    public function action_add_item($index)
    {
        $class = \Input::get('model');
        $relation = \Input::get('relation');
        $order = \Input::get('order');
        $forge = \Input::get('forge', array());
        $crud_item_details = \Input::get('crud_item', array());
        if (!empty($forge)) {
            $base_item = $class::forge($forge);//if the forge contains an id, then it will not be considered as a new item
            $item = clone $base_item;
        } else {
            $item = $class::forge();
        }

        $params = array(
            'renderer_item' => $item,
            'relation' => $relation,
            'index' => $index,
            'options' => array('order' => (int) $order),
        );
        if (!empty($crud_item_details['model']) && !empty($crud_item_details['id'])) {
            $params['crud_item'] = $crud_item_details['model']::find($crud_item_details['id']);
        }
        $return = Renderer_HasMany::render_fieldset($params);
        \Response::forge($return)->send(true);
        exit();
    }
}
