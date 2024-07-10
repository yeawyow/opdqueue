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
                        <h3 class="title">เลือกคลินิกที่ส่งตรวจล่วงหน้า</h3>
                    </div>
                    <div class="tile-body">
                        <p></p>
                        <!-- <select class="form-control" id="demoSelect" multiple=""></select> -->
                        <select class=" form-control" id="ForwardSelect" name="itemName"  multiple="">
                            <?php 
                                foreach($qdep as $row)
                                { 
                                echo '<option value="'.$row->depcode.'">'.$row->depcode.' : '.$row->department.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="button" id="ForwardSave">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก
                        </button>
                    </div>
                </div><!-- title -->
            </div> <!-- col-md-6 -->
        </div>
    </main>

<?php $this->load->view('footer');?>