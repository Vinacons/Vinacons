<?php
  session_start();
  ob_start();

  include('../view/db.php');

  //truy van bang hoc vien
  // Truy vấn để lấy dữ liệu từ cơ sở dữ liệu
  $query = "SELECT * FROM tblhocvien";
  $result = mysqli_query($con, $query);

  // Lấy dữ liệu từ kết quả truy vấn
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  //dua vao session hoc vien
  $_SESSION['hocvien'] = $data;

  
  //end


  //lọc theo input :date

  $datehocvien = $_POST['datehocvien'];

  // Thực hiện truy vấn theo ngày tháng đã nhập
  $querydatehocvien = "SELECT * FROM tblhocvien WHERE DATE(datetimee) = '$datehocvien'";
  $resultdatehocvien = mysqli_query($con, $querydatehocvien);

  // Lấy dữ liệu từ kết quả truy vấn
  $datadatehocvien = mysqli_fetch_all($result, MYSQLI_ASSOC);
  

  $_SESSION['datadatehocvien'] = $datadatehocvien;

  // end
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css"> -->
  <link rel="stylesheet" href="../fontawesome-free-6.2.1-web/css/all.min.css">
  <link rel="stylesheet" href="adminstyle.css">
  <style>
  body {
    position: relative;
  }
  
  ul.nav-pills {
    top: 176px;
    position: fixed;
  }
  li{
    list-style: none;
  }
  div.col-8 div {
    height: 500px;
  }
  table {
      width: 100%;
      border-collapse: separate; /* Sử dụng border-collapse: separate */
      /* border-spacing: 0 8px; Đặt khoảng cách giữa các ô */
    }
  th{
    background-color:#D9D9D9;
    margin: 0 10px;
  }
  
  th:not(:last-child),
    td:not(:last-child) {
      border-right: 2px solid #ddd; /* Kẻ hở giữa các cột */
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #0F30BF;
    }
    .nav-pills .nav-link {
    background: 0 0;
    border: 0;
    color: #fff;
    border-radius: 0.25rem;
    background-color: #D9D9D9;
    color: #000;
    }
    .tab-pane{
        height: 100vh;
    }

    .nav-link{
        margin: 9px 0;
    }
  </style>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid footer-main">
          <div class="navbar-header footer">
            <a class="navbar-brand nameweb" href="#"><img style="width: 100px;"     alt="">VINACONS</a>
            <a class="navbar-brand imgcourse" href="#"><img style="width: 90px;"   src="../img/logo.jpg" alt=""></a>
          </div>
        </div>
    </nav>

    <div class="container-fluid">
        
 
      <div class="row">
        <div class="col-md-2 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Học Viên</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tài Liệu</a>
      </li>
      
    </ul>
        </div>
    
    <div class="col-md-10">
        <div class="tab-content" id="myTabContent">
        <!-- Học viên -->
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        
        <!-- form search Học viên -->
        <!-- <form action="" method="post">
                    <div class="action__hocvien">


                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="hocvienhomnay" id="" value="checkedValue" >
                       Học viên Hôm Nay
                      </label>
                    </div>

                    <div class="">
                        <input type="date" name="datehocvien" id="">
                    </div>

                    <div class="form-group">
                        <input type="text" name="searchtheotenhocvien" placeholder="Nhập tên học viên">
                        <button type="submit" class="search-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                     
                        </button>
                      </div>
                </div>
            </form> -->
            <form action="" method="post">
    <div class="action__hocvien">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="hocvienhomnay" id="hocvienhomnay" value="checkedValue">
                Học viên Hôm Nay
            </label>
        </div>
        <div class="">
            <input type="date" name="datehocvien" id="">
        </div>
        <div class="form-group">
            <input type="text" name="searchtheotenhocvien" placeholder="Nhập tên học viên">
            <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
</form>
           <!--  -->
        <h2 class="header__admin">Học Viên</h2>
      
        <!-- table hoc vien -->
        <table style="width: 100%;text-align: center;">
            <thead>
              <tr>
                <th>Tên</th>
                <th>Số điện thoại </th>
                <th>Email </th>
                <th>Tên Khóa Học </th>
                <th>Ngày Đăng Kí</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
                <td>Data 5</td>
              </tr> -->
              
             <?php
                foreach ($_SESSION['hocvien'] as $hv  ) {
                 echo'
                 <tr>
                <td>'.$hv['hovaten'].'</td>
                <td>'.$hv['phone'].'</td>
                <td>'.$hv['email'].'</td>
                <td>'.$hv['tenkhoahoc'].'</td>
                <td>'.$hv['datetimee'].'</td>
              </tr> 
                 ';
                }
             ?>
            </tbody>
          </table>
      </div>


    <!-- Tài Liệu -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div style="display: flex;" class="">


                        <h2 style="width: 27%;" class="header__admin">Chủ đề</h2>
                        <h2 style="    width: 73%;" class="header__admin">Tài Liệu</h2>
                </div>
            

                <div class="content__tailieu">

                    <!-- start -->
 
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-3">
                          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="tab1-tab" data-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Tab 1</a>
                          </div>
                          <button class="btn btn-primary mt-3" id="addTabBtn">Thêm Chủ Đề</button>
                        </div>
                        <div class="col-9">
                          <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                              Content 1
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="addTabModal" tabindex="-1" role="dialog" aria-labelledby="addTabModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="addTabModalLabel">Add Tab</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <input type="text" id="tabNameInput" class="form-control" placeholder="Enter tab name">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveTabBtn">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div>
      </div>

    </div>
 
    <script>
  $(document).ready(function() {
    // Biến lưu trữ dữ liệu ban đầu
    var originalData = <?php echo json_encode($_SESSION['hocvien']); ?>;
    var currentData = originalData;

    // Hiển thị dữ liệu ban đầu khi trang được tải lần đầu
    displayData(currentData);

    // Sử dụng jQuery để theo dõi sự kiện khi checkbox được thay đổi
    $('#hocvienhomnay').on('change', function() {
      // Lấy giá trị checkbox (true nếu được chọn, false nếu không)
      var isChecked = $(this).is(':checked');

      // Nếu checkbox được chọn, lọc dữ liệu mới từ dữ liệu ban đầu
      if (isChecked) {
        currentData = originalData.filter(function(hv) {
          var ngayDangKy = new Date(hv.datetimee);
          var homNay = new Date();
          return ngayDangKy.toDateString() === homNay.toDateString();
        });
      } else {
        // Ngược lại, hiển thị dữ liệu ban đầu
        currentData = originalData;
      }

      // Hiển thị dữ liệu đã lọc hoặc dữ liệu ban đầu
      displayData(currentData);
    });

    // Sử dụng jQuery để theo dõi sự kiện khi ngày tháng được chọn
    $('input[name="datehocvien"]').on('change', function() {
      var selectedDate = $(this).val();

      // Nếu ngày tháng được chọn thì lọc dữ liệu mới từ dữ liệu ban đầu
      if (selectedDate !== '') {
        currentData = originalData.filter(function(hv) {
          var ngayDangKy = new Date(hv.datetimee);
          var inputDate = new Date(selectedDate);
          return ngayDangKy.toDateString() === inputDate.toDateString();
        });
      } else {
        // Ngược lại, hiển thị dữ liệu ban đầu
        currentData = originalData;
      }

      // Hiển thị dữ liệu đã lọc hoặc dữ liệu ban đầu
      displayData(currentData);
    });

    // Sử dụng jQuery để theo dõi sự kiện "keyup" của input "searchtheotenhocvien"
    $('input[name="searchtheotenhocvien"]').on('keyup', function() {
      var searchValue = $(this).val().trim().toLowerCase();

      // Nếu giá trị tìm kiếm không rỗng
      if (searchValue !== '') {
        // Lọc dữ liệu theo giá trị tìm kiếm
        currentData = originalData.filter(function(hv) {
          var tenHocVien = hv.hovaten.toLowerCase();
          return tenHocVien.includes(searchValue);
        });
      } else {
        // Nếu giá trị tìm kiếm rỗng, hiển thị dữ liệu ban đầu
        currentData = originalData;
      }

      // Hiển thị dữ liệu đã lọc hoặc dữ liệu ban đầu
      displayData(currentData);
    });

    // Hàm hiển thị dữ liệu lên bảng
    function displayData(data) {
      $('tbody').empty();

      data.forEach(function(hv) {
        var row = '<tr>' +
          '<td>' + hv.hovaten + '</td>' +
          '<td>' + hv.phone + '</td>' +
          '<td>' + hv.email + '</td>' +
          '<td>' + hv.tenkhoahoc + '</td>' +
          '<td>' + hv.datetimee + '</td>' +
        '</tr>';
        $('tbody').append(row);
      });
    }
  });
</script>
    
    <script>
      $(document).ready(function() {
 var counter = 1;

 // Khi nút "Add" được nhấp
 $('#addTabBtn').on('click', function() {
   $('#addTabModal').modal('show'); // Mở modal
 });

 // Khi nút "Save" trong modal được nhấp
 $('#saveTabBtn').on('click', function() {
   var tabName = $('#tabNameInput').val();

   if (tabName !== '') {
     counter++;

     // Tạo tab mới
     var tabId = 'tab' + counter;
     var tabTitle = 'Tab ' + counter;
     var tabContent = 'Content ' + counter;

     // Thêm tab mới vào danh sách tabs
     $('#v-pills-tab').append('<a class="nav-link" id="' + tabId + '-tab" data-toggle="pill" href="#' + tabId + '" role="tab" aria-controls="' + tabId + '" aria-selected="false">' + tabName + '</a>');

     // Thêm nội dung của tab mới
     $('#v-pills-tabContent').append('<div class="tab-pane fade" id="' + tabId + '" role="tabpanel" aria-labelledby="' + tabId + '-tab">' + tabContent + '</div>');

     // Kích hoạt tab mới
     $('#' + tabId + '-tab').tab('show');

     $('#addTabModal').modal('hide'); // Đóng modal
     $('#tabNameInput').val(''); // Xóa giá trị trong input
   }
 });
});


     </script>
</body>
</html>
