<?php
  require 'session.php';
  include 'navbar.php';
  require_once 'model/db.php';

  $msg = $msgClass = '';
  function get_price($date1, $date2) {
    $diff = date_diff(date_create($date1), date_create($date2));
    $price = $diff->format("%a");
    return $price * 1;
  }

  // handle the get request base on user id
  if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "SELECT * FROM `booking` WHERE `service_name`='$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    $_SESSION['service_name'] = $row['service_name'];
    $_SESSION['service_price'] = $row['service_price'];
  }

  // Process booked locker and insert into database
  if (filter_has_var(INPUT_POST, 'book')) {
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sid = mysqli_real_escape_string($conn, $_POST['userid']);
    $lid = mysqli_real_escape_string($conn, $_POST['lockerid']);
          // check date if start date lower then end date output some error
          if ($end <= $start) {
            $msg = "Please pick a correct date";
            $msgClass = "red";
          } else {
            $totalPrice = get_price($start, $end);

            $sql = "INSERT INTO `record` (record_start, record_end, record_price, client_name, service_name)
            VALUES ('$start', '$end', '$totalPrice', '$sid', '$lid');";
            $sql .= "UPDATE `locker` SET service_status='Booked' WHERE service_name='$lid'";
  
            $result = mysqli_multi_query($conn, $sql);
            if ($result) {
              do {
                // grab the result of the next query
                if (($result = mysqli_store_result($conn)) === false && mysqli_error($conn) !='') {
                   //echo "Query failed: " . mysqli_error($mysqli);
                }
              } while (mysqli_more_results($conn) && mysqli_next_result($conn));
              
              $msg = "<a href='index.php' class='white-text'><i class='fas fa-arrow-circle-left'></i></a> Booking success";
              $msgClass = "green";
            } else {
               echo "First query failed..." . mysqli_error($conn);
            }
          }
        
  }
  mysqli_close($conn);

?>
<section class="section">
  <div class="container">
    <h5><i class="fab fa-wpforms"></i> Booking information</h5>
    <div class="divider"></div><br>
    <?php if($msg != ''): ?>
      <div class="card-panel <?php echo $msgClass; ?>">
        <span class="white-text"><?php echo $msg; ?></span>
      </div>
    <?php endif ?>
    <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="card-panel">
      <div class="row">
        <div class="input-field col s6 m6">
          <input readonly type="text" id="lockerid" name="lockerid" value="<?php echo $_SESSION['service_name']; ?>">
          <label for="id">Locker id</label>
        </div>
        <div class="input-field col s6 m6">
          <input readonly type="text" id="userid" name="userid" value="<?php echo $_SESSION['s_id']; ?>">
          <label for="id">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6">
          <input id="start" type="text" class="datepicker" name="start">
          <label for="start">Start date</label>
        </div>
        <div class="input-field col s6 m6">
          <input id="end" type="text" class="datepicker" name="end">
          <label for="end">End date</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6">
          <input readonly type="text" id="price" name="price" value="<?php echo $_SESSION['service_price']; ?>">
          <label for="price">Locker Price (JMD) / day</label>
        </div>
        
      <div class="center">
        <a href="index.php" class="btn btn-flat">Cancel</a>
        <button type="submit" name="book" class="btn green">Book now</button>
      </div>
    </form>
  </div>
</section>
<?php
  include 'footer.php';
?>
