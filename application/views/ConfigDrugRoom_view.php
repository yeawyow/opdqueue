<?php $this->load->view('header');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> ตั้งค่าห้องจ่ายยา</h1>
          <p>กำหนด ComputerName ห้องยา  </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">ตั้งค่าห้องจ่ายยา</a></li>
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
                    <select class="form-control" id="DrugSelect">
                      <option value="0">ต้องการเรียก ชื่อ-สกุล</option>
                      <option value="1">ต้องการเรียก คิวรวม</option>
                      <option value="2">ต้องการเรียก คิวห้องยา</option>
                    </select>
                  </div>
                </form>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="button" id="drugsubmit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                </button>
            </div>
          </div> <!-- title -->
        </div> <!-- col-md-6 -->

        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">ห้องจ่ายยาผู้ป่วยนอก</h3>
            </div>
            <div class="tile-body">
              <select class=" form-control" id="DrugOPDSelect" name="itemName"  multiple="">
                  <?php 
                      foreach($qdep as $row)
                      { 
                      echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                      }
                  ?>
              </select>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="button" id="DrugSubmitOPD">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                </button>
            </div>
          </div> <!-- title -->
        </div> <!-- col-md-6 -->

        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">ห้องจ่ายยาผู้ป่วยใน</h3>
            </div>
            <div class="tile-body">
              <select class=" form-control" id="DrugIPDSelect" name="itemName"  multiple="">
                  <?php 
                      foreach($qdep as $row)
                      { 
                      echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                      }
                  ?>
              </select>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="button" id="DrugSubmitIPD">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                </button>
            </div>
          </div> <!-- title -->
        </div> <!-- col-md-6 -->        

      </div> <!-- row -->
    </main>

<?php $this->load->view('footer');?>