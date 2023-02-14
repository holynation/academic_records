<?php include_once ROOTPATH."template/header.php"; ?>

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-6 mb-0">
      <div class="card">
        <div class="card-body">
          <span class="fw-semibold d-block mb-0">Total Students</span>
          <h3 class="card-title mb-2"><?php echo number_format(@$countData['student']); ?></h3>
          <a href="<?php echo base_url("vc/create/student_biodata"); ?>">
            <small class="text-primary fw-semibold">View Students
              <i class="bx bx-up-arrow-alt"></i>
            </small>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-0">
      <div class="card">
        <div class="card-body">
          <span class="fw-semibold d-block mb-0">Total Staffs</span>
          <h3 class="card-title mb-2"><?php echo number_format(@$countData['lecturer']); ?></h3>
          <a href="<?php echo base_url("vc/create/staff"); ?>">
            <small class="text-success fw-semibold">View Staffs
              <i class="bx bx-up-arrow-alt"></i>
            </small>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-6 mb-0">
      <div class="card">
        <div class="card-body">
          <span class="fw-semibold d-block mb-0">Student Registration</span>
          <h3 class="card-title mb-2"><?php echo number_format(@$countData['student_registration']); ?></h3>
          <a href="<?php echo base_url(""); ?>">
            <small class="text-info fw-semibold">Total Registered Student
              <i class="bx bx-up-arrow-alt"></i>
            </small>
          </a>
        </div>
      </div>
    </div>

    <!-- here is donut graph -->
    <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Applicant Gender Chart</h5>
            <div class="chart has-fixed-height" id="gender-pie"></div>
          </div>
        </div>
      </div>
    </div>

      <!-- Total Revenue -->
      <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-12">
              <h5 class="card-header m-0 me-2 pb-3">Student Registration Course Distribution</h5>
              <div id="totalApplicantChart" class="px-2"></div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- / Content & end for last graph-->

<?php include_once ROOTPATH."template/footer.php"; ?>
<script src="<?php echo base_url('assets/vendor/libs/morris/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/libs/morris/morris.min.js') ?>"></script>

<script>
  // addMoreEvent is loaded directly under custom.js
   function addMoreEvent() {
      loadStaffStatusChart();
      loadGenderChart();
   }

   function loadGenderChart() {
    var val = JSON.parse('<?php echo json_encode(@$genderDistrix) ?>');
    if (val !== undefined){
      Morris.Donut({
        element: 'gender-pie',
        data:val,
        xkey: 'gender',
        ykeys: ['total'],
        labels: ['Y', 'Z'],
        colors: [
          '#00BCD4',
          '#B2EBF2',
          '#ffa9ce',
           '#B6A2DE',
           '#EB0F82',
           '#202A5A'
        ]
      });
    }
   }

   function loadStaffStatusChart() {
    var val = JSON.parse('<?php echo json_encode(@$staffStatusDistrix) ?>');
    if (val !== undefined){
      Morris.Donut({
        element: 'staff-pie',
        data:val,
        labels: ['Y', 'Z', 'A','B'],
        colors: [
          '#2EC7C9',
           '#B6A2DE',
           '#ffa9ce',
           '#B2EBF2',
        ]
      });
    }
   }
</script>
