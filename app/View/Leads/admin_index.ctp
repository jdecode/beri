<div class="leads index">
    <h2><?php echo __('Leads'); ?></h2>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>

                <th width="10%"><?php echo $this->Paginator->sort('link'); ?></th>
                <th width="20%"><?php echo $this->Paginator->sort('title'); ?></th>
                <th width="40%"><?php echo $this->Paginator->sort('description'); ?></th>
                <th width="25%"><?php echo "<a>Placed Bid By</a>"; //$this->Paginator->sort('description');                  ?></th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($leads)) {
                foreach ($leads as $lead):
                    ?>
                    <tr>
                        <td><?php echo($lead['Lead']['id']); ?>&nbsp;</td>

                        <td><?php
                           
                            echo $this->Html->link(
                                    $sources[$lead['Lead']['source']], $lead['Lead']['link'], array(
                                "class" => "go_to_link",
                                "lid" => $lead['Lead']['id'],
                                'target' => '_blank'
                                    )
                            );

                            //echo "<a href=\"{$lead['Lead']['link']}\">{$sources[$lead['Lead']['source']]}</a>";
                            ?>&nbsp;&nbsp;
                            <span class='img-circle' style="background: none repeat scroll 0 0 rgb(66, 139, 202);
                                  color: #fff;
                                  float: right;
                                  font-size: 11px;
                                  padding: 1px;
                                  width: 18px;">&nbsp;
                                  <?php
                                  if (!empty($setDataV) && array_key_exists($lead['Lead']['id'], $setDataV)) {
                                      echo $setDataV[$lead['Lead']['id']];
                                  } else {
                                      echo 0;
                                  }
                                  ?>
                            </span>
                        </td>
                        <td><?php echo ($lead['Lead']['title']); ?>&nbsp; </td>
                        <td>
                            <div style=" overflow-y: scroll;height: 150px;"> <?php echo $lead['Lead']['description']; ?></div>

                        </td>

                        <td>
                            <div style=" overflow-y: scroll;height: 150px;">

                                <?php
                                if (!empty($setDataU) && array_key_exists($lead['Lead']['id'], $setDataU)) {
                                    foreach ($setDataU[$lead['Lead']['id']] as $val) {
                                        
                                        if($val["bid_status"]==5){
                                            $bgcolor="background-color:#EDF7ED;";
                                            $starpin="<span class=\"glyphicon glyphicon-star\" style=\"color:#006599;\"></span>";
                                        }else{
                                          $bgcolor="";
                                            $starpin="";   
                                        }
                                        ?>
                                        <div style="border-bottom: 1px solid #C2F8FF; padding:2px 5px;<?php echo $bgcolor;?>"><?php printf("%s%s <br/>[%s]",$starpin, $val["name"], $val["email"]); ?> </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div >None.</div>
                                <?php } ?>
                            </div>
                        </td>

                    </tr>
                    <?php
                endforeach;
            } else {
                ?>
                <tr><td colspan="5">No records found.</td></tr>
            <?php }
            ?>
        </tbody>
    </table>
    <style>
        #openListStatus {
            display: none;
        }
        .statusList:hover #openListStatus {
            display:block;
            cursor: pointer;
        }
    </style>
    <p>
        <?php
        /* echo $this->Paginator->counter(array(
          'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
          )); */
        ?>	</p>
    <?php
    $pages = $this->Paginator->params();
    if (!empty($pages) && $pages["count"] > 1) {
        ?>
        <div class="pagination pagination-left">
            <ul>
                <?php
                echo $this->Paginator->first('<<', array('class' => '', 'tag' => 'li', "title" => "First"), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                echo $this->Paginator->prev('<', array('class' => '', 'tag' => 'li', "title" => "Previous"), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));
                echo $this->Paginator->next('>', array('class' => '', 'tag' => 'li', "title" => "Next"), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                echo $this->Paginator->last('>>', array('class' => '', 'tag' => 'li', "title" => "Last"), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                ?>
            </ul>
        </div>
    <?php } ?>

</div>



<div class="modal hide fade" id="StartProjectModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="clearfix"></div>
    </div>
    <div class="modal-body">
        <div class="projects form">
            <?php echo $this->Form->create('Project', array('url' => '/leads/start_project_in', 'class' => 'form_required')); ?>
            <fieldset>
                <legend>Add Project</legend>

                <?php
                echo $this->Form->input('name');
                echo $this->Form->input('code');
                $project_statuses = Configure::read('project_statuses');
                echo $this->Form->input('status', array('options' => $project_statuses));
                ?>
            </fieldset>
            <?php
            echo $this->Form->button('Save', array('class' => 'btn btn-inverse'));
            ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <!--
    <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Close</button>
            <button data-dismiss="modal" class="btn btn-primary">Save</button>
    </div>
    -->
</div>