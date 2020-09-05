<style>
    .treeview .list-group-item{cursor:pointer}.treeview span.indent{margin-left:10px;margin-right:10px}.treeview span.icon{width:12px;margin-right:5px}.treeview .node-disabled{color:silver;cursor:not-allowed}.node-treeview12{}.node-treeview12:not(.node-disabled):hover{background-color:#F5F5F5;} 
    .badge {
        font-size: 11px !important;
        font-weight: 300;
        text-align: center;
        height: 18px;
        padding: 3px 6px 3px 6px;
        -webkit-border-radius: 12px !important;
        -moz-border-radius: 12px !important;
        border-radius: 12px !important;
        text-shadow: none !important;
        text-align: center;
        vertical-align: middle;
        background-color: transparent!important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">{view-header-title}</span>
                    <small>logged in required</small>
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet blue box">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Menu </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-tabs" id="navmenu">
                            <?php
                            if (isset($modules) && !empty($modules)) {
                                foreach ($modules AS $k => $v) {
                                    $active = '';
                                    if ($v->id == 1) {
                                        $active = 'class="active"';
                                    }
                                    ?>
                                    <li <?php echo $active; ?>>
                                        <a data-type="tab" data-module_id="<?php echo $v->id; ?>" data-module_name="<?php echo $v->name; ?>" href="#tab_2_<?php echo $v->id; ?>" data-toggle="tab"> <?php echo $v->name; ?> </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            if (isset($modules) && !empty($modules)) {
                                foreach ($modules AS $k => $v) {
                                    $active2 = '';
                                    if ($v->id == 1) {
                                        $active2 = 'active';
                                    }
                                    ?>
                                    <div class="tab-pane fade <?php echo $active2; ?> in" id="tab_2_<?php echo $v->id; ?>">
                                        <div id="tree_<?php echo $v->id; ?>" class="tree-frm treeview"> </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>					
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<!-- /.modal -->
<div id="modal_add_edit" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frm_add_edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="title_mdl"></h4>
                </div>
                <div class="modal-body">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Menu Options
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <ul class="nav nav-tabs tabs-left">
                                        <?php if (isset($menu_actions) && !empty($menu_actions)): ?>
                                            <?php for ($i = 0; $i < count($menu_actions); $i++): ?>
                                                <li<?php echo ($i == 0) ? ' class="active"' : ''; ?>>
                                                    <a href="#tab_6_<?php echo $i; ?>" class="aTab cl-<?php echo $i; ?>" data-i="<?php echo $i; ?>" data-toggle="tab" data-type="<?php echo strtolower($menu_actions[$i]); ?>"> <?php echo $menu_actions[$i]; ?> </a>
                                                </li>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="tab-content">
                                        <?php if (isset($menu_actions) && !empty($menu_actions)): ?>
                                            <?php for ($i = 0; $i < count($menu_actions); $i++): ?>
                                                <div class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="tab_6_<?php echo $i; ?>"></div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group-vertical" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-secondary" data-type="view">View</button>
                                    <button type="button" class="btn btn-secondary" data-type="add">Add</button>
                                    <button type="button" class="btn btn-secondary" data-type="edit">Edit</button>
                                    <button type="button" class="btn btn-secondary" data-type="remove">Remove</button>
                                    <button type="button" class="btn btn-secondary" data-type="delete">Delete</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div id="resModPop"></div>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="modal-footer">
                    <input type="text" name="frm_add_edit_id" hidden />
                    <input type="text" name="frm_add_edit_parent_id" hidden />
                    <input type="text" name="frm_add_edit_module_id" hidden />
                    <input type="text" name="frm_add_edit_level" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    <button type="submit" class="btn btn-secondary" value="submit" id="submit" disabled="">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>