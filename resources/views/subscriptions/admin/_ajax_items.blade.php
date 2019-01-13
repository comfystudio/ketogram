<div class="form-group" id= "item-group_<?php echo $current ?>">
    <label class="col-md-2 control-label" for="items[<?php echo $current ?>]">Item <?php echo $current ?></label>
    <div class="col-md-5">
        <select id="items[<?php echo $current ?>]" name="items[<?php echo $current ?>]" class="form-control">
            <option value="0">-- Please Select Item --</option>
            <?php foreach($items as $key => $item){?>
                <option value="<?php echo $key?>">
                    <?php echo $item?>
                </option>
            <?php } ?>
        </select>
    </div>
    <a data-toggle="tooltip" id= "remove-item_{{$current}}" title="Remove Item" class="btn btn-effect-ripple btn-sm btn-danger remove-item" data-id="{{$current}}"><i class="fa fa-times"></i></a>
</div>