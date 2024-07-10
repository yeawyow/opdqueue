<div class="col-md-12 col-lg-12">
          <div class=" widget-small primary coloured-icon " ><i class="icon" ><strong>1</strong></i>
              <div class="info ch1" id="ch1" style="color:#003300;font-size:50px;"><strong ></strong></div>
          </div>
          
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>2</strong></i>
              <div class="info ch2" id="ch2" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>3</strong></i>
              <div class="info ch3" id="ch3" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>4</strong></i>
              <div class="info ch4" id="ch4" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>

          <div class="table-responsive">
            <table class="table">
                <col style="width:15%">
                <col style="width:85%">
              <thead>
                <tr style="background-color: #000000;">
                  <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">เร่งด่วน</th>
                </tr>
              </thead>
              <tbody>
              <?php  foreach ($priority as $pri):?>
                <tr id="<?php  if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $pri->main_dep_queue;}else{ echo $pri->oqueue;}?>"
                      <?php if($pri->pt_priority == 2){
                        echo 'style="color:#000000;font-size:42px;background-color:#f00000"';
                        echo ' class="p2"';
                      }else if($pri->pt_priority == 1){
                        echo 'style="color:#000000;font-size:42px;background-color:#ff9900"';
                        echo ' class="p1"';
                      }?>>
                  <td> <?php 
                      if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $pri->main_dep_queue;
                      }else{
                        echo $pri->oqueue;
                      }
                    ?>
                  </td>
                  <td><strong class="<?php echo $pri->oqueue;?>"><?php echo $pri->ptname?></strong>&nbsp
                    <?php 
                      if($pri->lab_count !='' && $pri->report_count !=''){
                        if($pri->lab_count > $pri->report_count){
                            echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                        }else if($pri->lab_count == $pri->report_count){
                            echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                        } 
                      }
                        echo '&nbsp';
                        if($pri->confirm_all=='N'){
                          echo '<img src="'.base_url().'assets/img/radiation.png" class="jrotate" height="32" width="32">';
                        }else if($pri->confirm_all=='Y'){
                            echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                        }
                      
                    ?>
                  </td>
                  <td><strong id ="chanel_<?php echo $pri->hn;?>"></strong></td>
                </tr>
                    <?php endforeach;?>
              </tbody>
            </table>
          </div>
          

        </div>

        
        <div class="col-md-6">
         <!--  <div class="col-md-12"> -->
          <div class="table-responsive">
            <table class="table" id="tblnormal" >
                <col style="width:15%">
                <col style="width:85%">
              <thead>
                <tr style="background-color: #0000b3;">
                  <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
                </tr>
              </thead>
              
              <tbody>
              <?php foreach ($pt as $item):?>
               
                <tr id="<?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                       
                      } ?>" class="n1" style="color:#000000;font-size:42px;background-color:#00cc00">
                  <td >
                    <?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                      }                    
                    ?>
                    </td>
                  <td>
                    <strong class="<?php echo $item->oqueue;?>"><?php echo $item->ptname?></strong>&nbsp
                      <?php
                        if ($item->lab_count !='' && $item->report_count !=''){
                          if($item->lab_count > $item->report_count){
                              echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                            }else if($item->lab_count == $item->report_count){
                              echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                          }
                        } 
                          echo '&nbsp';
                          if($item->confirm_all=='N'){
                            echo '<img src="'.base_url().'assets/img/radiation.png" class="jrotate" height="32" width="32">';
                          }else if($item->confirm_all=='Y'){
                              echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                          }
                      ?>
                  
                  </td>
                  <td><strong id ="chanel_<?php echo $item->hn;?>" class="<?php echo $item->oqueue;?>"></strong></td>
                </tr>
              <?php endforeach;?>
              </tbody>
              
            </table>
          </div>

        <!-- </div> -->

        </div>
        
     
    
                        </div>