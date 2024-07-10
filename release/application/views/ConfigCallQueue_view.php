<?php $this->load->view('header');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> ตั้งค่า</h1>
          <p>ตั้งค่าพื้นฐาน</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
      
            <div class="col-md-6">
              <div class="tile">
                <div class="tile-title-w-btn">
                  <h3 class="title">เลือกการเรียกคิว/ชื่อ</h3>
                </div>
                <div class="tile-body">
                   <form id="frm">
                      <div class="form-group">
                        <label for="exampleSelect1">เรียกโดยใช้คิว หรือ ชื่อ-สกุล</label>
                        <select class="form-control" id="Select1">
                          <option value="N">ต้องการเรียก ชื่อ-สกุล</option>
                          <option value="Y">ต้องการเรียก คิว</option>
                        </select>
                      </div>
                    </form>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div> <!-- title -->
            </div> <!-- col-md-6 -->

            <div class="col-md-6">
              <div class="tile">
                <div class="tile-title-w-btn">
                  <h3 class="title">เลือกให้เรียกคิวรวม / คิวย่อย</h3>
                </div>
                <div class="tile-body">
                   <form id="frm">
                      <div class="form-group">
                        <label for="exampleSelect1">เรียกโดยใช้คิวร่วม หรือ คิวย่อย</label>
                        <select class="form-control" id="subqueue">
                          <option value="N">ต้องการเรียก คิวรวม</option>
                          <option value="Y">ต้องการเรียก คิวย่อย</option>
                        </select>
                      </div>
                    </form>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="submitSubQ">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div> <!-- title -->
            </div> <!-- col-md-6 -->

            <div class="col-md-6">
              <div class="tile">
                <div class="tile-title-w-btn">
                  <h3 class="title">กำหนดความยามของ HN ที่ใช้</h3>
                </div>
                <div class="tile-body">
                  <form>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ความยามของเลข HN </label>
                      <input class="form-control is-valid" id="hn" type="text">
                    </div>
                  </form>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="submitHN">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div> <!-- title -->
            </div> <!-- col-md-6 -->
       
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                    <h3 class="title">รอซักประวัติ</h3>
                </div>
                <div class="tile-body">
                    <p>เลือกแผนกที่ต้องการให้รายชื่อผู้ป่วยแสดงที่จอรอซักประวัติของจุด OPD</p>
                    <!-- <select class="form-control" id="demoSelect" multiple=""></select> -->
                    <select class=" form-control" id="demoSelect" name="itemName"  multiple="">
                        <?php 
                            foreach($qdep as $row)
                            { 
                            echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="save">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div><!-- title -->
            </div> <!-- col-md-6 -->

            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                    <h3 class="title">รอพบแพทย์</h3>
                </div>
                <div class="tile-body">
                    <p>เลือกแผนกที่ต้องการให้รายชื่อผู้ป่วยแสดงที่จอรอพบแพทย์ OPD</p>
                    <!-- <select class="form-control" id="demoSelect" multiple=""></select> -->
                    <select class=" form-control" id="docSelect" name="itemName"  multiple="">
                        <?php 
                            foreach($qdep as $row)
                            { 
                            echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="DocSave">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div><!-- title -->
            </div> <!-- col-md-6 -->

            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                    <h3 class="title">คลินิกพิเศษ</h3>
                </div>
                <div class="tile-body">
                    <p>เลือกแผนกที่ต้องการให้รายชื่อผู้ป่วยแสดงที่จอรอพบแพทย์ OPD</p>
                    <!-- <select class="form-control" id="demoSelect" multiple=""></select> -->
                    <select class=" form-control" id="NCDSelect" name="itemName"  multiple="">
                        <?php 
                            foreach($qdep as $row)
                            { 
                            echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="NCDSave">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>
                </div>
              </div><!-- title -->
            </div> <!-- col-md-6 -->

            
            
      </div>
    </main>

<?php $this->load->view('footer');?>