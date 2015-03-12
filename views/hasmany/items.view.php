<?php
\Nos\I18n::current_dictionary('novius_renderers::default');
?>
<div class="hasmany_items count-items-js" data-nb-items="<?= empty($item->{$relation}) ? 1 : count($item->{$relation}) ?>">
    <div class="item_list">
        <?php
        $i = 0;
        if (!empty($relation) && count($item->{$relation})) {
            foreach ($item->{$relation} as $o) {
                // Build fieldset and return view
                echo \Novius\Renderers\Renderer_HasMany::render_fieldset(array(
                    'renderer_item' => $o,
                    'relation' => $relation,
                    'index' => $i,
                    'options' => $options,
                    'crud_item' => $item,
                ));
                $i++;
            }
        } elseif (\Arr::get($options, 'default_item', true)) {
            // Display an empty item in case none have already been added
            echo \Novius\Renderers\Renderer_HasMany::render_fieldset(array(
                'renderer_item' => $model::forge(),
                'relation' => $relation,
                'index' => $i,
                'options' => $options,
                'crud_item' => $item,
            ));
        }
        ?>
    </div>

    <?php
    $attr = array(
        'data-icon' => 'plus',
        'data-model' => $model,
        'data-relation' => $relation,
        'data-order' => !empty($options['order']) ? 1 : 0,
        'data-crud_item' => \Format::forge(array('model' => get_class($item), 'id' => $item->id))->to_json()
    );
    ?>
    <button class="add-item-js button-add-item" <?= array_to_attr($attr) ?>><?= __('Add one item') ?></button>
</div>
