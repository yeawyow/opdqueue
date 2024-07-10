<?php $this->load->view('header');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> ตั้งค่าแสดงผลหน้าจอซักประวัติ</h1>
          <p>ต้องการกำหนดให้แสดงผลเฉพาะที่จะตรวจ ณ OPD</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">ตั้งค่าแสดงผลหน้าจอซักประวัติ</a></li>
        </ul>
      </div>
        <div class="row">
            
           <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                    <h3 class="title">เลือกแผนก</h3>
                </div>
                <div class="tile-body">
                    <p>เลือกแผนกที่ต้องการให้รายชื่อผู้ป่วยแสดงที่จอเรียกซักประวัติของจุด OPD</p>
                    <!-- <select class="form-control" id="demoSelect" multiple=""></select> -->
                    <select class=" form-control" id="demoSelect" name="itemName"  multiple="">
                        <?php 
                            foreach($qdep as $row)
                            { 
                            echo '<option value="'.$row->depcode.'">'.$row->department.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="save">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                    </button>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="#">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i>ยกเลิก
                        </a>
                </div>
            </div>
            
            

        </div>
    </main>

<?php $this->load->view('footer');?>