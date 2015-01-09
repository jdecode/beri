<div class="span6"><h2><?php echo __('Private Leads'); ?></h2></div>
<div class="span4 text-right" style="padding: 20px;"><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i>Add',array("controller"=>"leads","action"=>"add"),array("title"=>"Add private lead","escape"=>false));?></div>

<div class=" clearfix"></div>
<hr>
<div class="leads index">
    
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>

                <th><?php echo $this->Paginator->sort('link'); ?></th>
                <th><?php echo $this->Paginator->sort('title'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('Status'); ?></th>


            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($leads)) {
                foreach ($leads as $lead):
                    ?>
                    <tr <?php if (!empty($Awdprojects) && array_key_exists($lead['Lead']['id'], $Awdprojects)) { ?>style="background-color:#EDF7ED;"<?php } ?> >
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
                            ?>&nbsp;</td>
                        <td><?php echo ($lead['Lead']['title']); ?>&nbsp;</td>
                        <td>
                            <div style=" overflow-y: scroll;height: 150px;"> <?php echo $lead['Lead']['description']; ?></div>

                        </td>

                        <td width="10%" class="statusList"><?php
                            if (!empty($Awdprojects) && array_key_exists($lead['Lead']['id'], $Awdprojects)) {
                                $awdUdata = $this->Custom->userinfo($Awdprojects[$lead['Lead']['id']]);
                                ?>
                    <?php
                    printf(" <span class=\"glyphicon glyphicon-star\" style=\"color:#006599;\"></span> %s %s <br/> [%s]", $awdUdata['User']["first_name"], $awdUdata['User']["last_name"], $awdUdata['User']["email"]);
                } else {

                    //$status = array(1 => "Open bid", 2 => "Bid Placed", 3 => "Declined", 4 => "Feedback", 5 => "Project start");

                    //pr($userBidStatus);
                    if (!empty($userBidStatus) && (array_key_exists($lead['Lead']['id'], $userBidStatus))) {
                        $mystatus = $userBidStatus[$lead['Lead']['id']];
                    } else {
                        $mystatus = 1;
                    }
                    ?>

                    <div class="statusListdiv">
                        <div id="mainTxt<?php echo $lead['Lead']['id']; ?>">
                            <?php
                            for ($i = 1; $i <= $mystatus; $i++) {

                                if ($i == $mystatus) {
                                    $txtdecostyle = "text-decoration:none";
                                } else {
                                    $txtdecostyle = "text-decoration:line-through;color:#A9A9A9";
                                }
                                if ($i == 3) {
                                    continue;
                                }
                                echo "<span style='$txtdecostyle'>" . $leads_status[$i] . "</span><br/>";
                            }
                            if ($mystatus == 3) {
                                echo "<span style='text-decoration:none'>" . $leads_status[$mystatus] . "</span><br/>";
                            }
                            ?>
                        </div>
                        <div id="openListStatus" >
                            <div id="next_id_set<?php echo $lead['Lead']['id']; ?>">
                                <?php
                                $next_status = array(1 => array(2 => "Bid Placed"), 2 => array(3 => "Declined", 4 => "Feedback"), 3 => array(), 4 => array(5 => "Project Start"));
                                $colorcodeArray = array(2 => "btn btn-small btn-info", 3 => "btn btn-small btn-danger change_status", 4 => "btn btn-small btn-warning change_status", 5 => "btn btn-small btn-success change_status");
                                if ($mystatus < 5) {
                                    foreach ($next_status[$mystatus] as $key => $val) {
                                        if (!empty($val)) {
                                            $colorcode = $colorcodeArray[$key];

                                            echo "<p><button class='change_status $colorcode' lid={$lead['Lead']['id']} status=$key>" . $val . "</button></p>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    </td>
                <?php } ?>
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