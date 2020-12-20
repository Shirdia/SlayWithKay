<?php
  session_start();
  include 'navbar.php';
  require 'model/db.php';
?>
<section class="section">
  <div class="container">
    <h5><i class="fas fa-box blue-text"></i> Booking List</h5>
    <div class="divider"></div><br>

    <div class="row">
      
      <div class="col s12 m9">
        <div class="row">
          <?php
            $sql = "SELECT * FROM `booking`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)):
          ?>
          <div class='col s6 m3'>
            <div class='card'>
              <div class='card-image'>
              </div>
              <div class='card-action'>
                <input type="hidden" name="id" value="<?php echo $row['service_name']; ?>">
                <div><?php echo $row['service_name']; ?></div>
                <div>JMD 1/day</div>
                <div class="<?php switch ($row['service_status']) {
                  case 'Available':
                    echo 'green-text';
                    break;
                  case 'Booked':
                    echo 'blue-text';
                    break;
                  case 'Damage':
                    echo 'red-text';
                    break;
                  default:
                    echo 'black-text';
                    break;
                } ?>"><?php echo $row['service_status'] ?></div><br>
                <?php if ($row['service_status'] == 'Available'): ?>
                  <div class="center">
                    <a href="booking.php?id=<?php echo $row['service_name']; ?>" class="btn blue">Book</a>
                  </div>
                <?php else: ?>
                  <div class="center">
                    <a href='' class='btn disabled'>Book</a>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>

     
      <div class="col s12 m3">
        <div class="row">
          <ul class="collection with-header z-depth-1">
            <li class="collection-header blue white-text">
              <i class="fas fa-box"></i> Bookings
            </li>
            <?php
              // Total
              $sql = "SELECT COUNT(service_name) as total from `booking`";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Total: <span class='secondary-content'>".$row['total']."</span></li>";

              // Available
              $sql = "SELECT COUNT(service_status) as available from `booking` WHERE service_status='Available'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Available: <span class='secondary-content green-text'>".$row['available']."</span></li>";

              // Booked
              $sql = "SELECT COUNT(service_status) as booked from `booking` WHERE service_status='Booked'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Booked: <span class='secondary-content'>".$row['booked']."</span></li>";

              // Damage
              $sql = "SELECT COUNT(service_status) as damage from `booking` WHERE service_status='Damage'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Damage: <span class='secondary-content red-text'>".$row['damage']."</span></li>";
            ?>
          </ul>
        </div>
      
    </div>
  </div>
</section>
<?php
  include 'footer.php';
?>
