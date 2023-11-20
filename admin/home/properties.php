<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .search {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .searchTerm {
        width: 30%;
        border: 3px solid #00B4CC;
        border-right: none;
        padding: 15.5px;
        height: 36px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: #9DBFAF;
    }

    .searchTerm:focus{
        color: #00B4CC;
    }

    .searchButton {
        width: 40px;
        height: 36px;
        border: 1px solid #00B4CC;
        background: #00B4CC;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Properties
            <a href="properties_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Property</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Properties</li>
        </ol>
        <div class="wrap mb-3">
            <h3>Apartments</h3>
            <div class="search">
                <input type="text" class="searchTerm" id="Search" onkeyup="myFunction()" placeholder="What are you looking for?" title="Type a property">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card-group" id="productList">
                    <?php
                    $query = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `staff_fullname` FROM `property` INNER JOIN `location` ON location.location_id = property.location_id INNER JOIN `user` ON user.user_id = property.user_id";
                    $query_run = mysqli_query($con, $query);
                    $property = mysqli_num_rows($query_run) > 0;
                    if ($property) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="col-12 col-md-6 col-lg-3 mb-4 target">
                        <a href="property_overview?id=<?=$row['property_id'];?>" style="text-decoration:none; color:black;">
                            <div class="card h-100">
                                <!-- <img class="img-fluid card-img-top" src="<?php echo base_url ?>assets/files/property/<?php echo $row['photo'];?>"  alt="user-avatar" style="height:250px; width: 100%; object-fit: cover;"> -->
                                <div class="card-body">
                                    <h3 class="card-title text-center" style="font-size: 22px;"><?php echo $row['property_name']; ?></h3>
                                    <p class="card-text text-center">Location: <?php echo $row['location_name'];?></p>
                                    <p class="card-text text-center">Cost: ₱<?php echo $row['property_cost'];?> </p>
                                    <p class="card-text text-center">
                                        <?php
                                            if ($row['property_status'] != 'Available') {
                                                echo "<span style='color:red'> (Not Available)</span>"; 
                                            } else {
                                                echo "<span style='color:green'> (Available)</span>"; 
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<div class='col-12 text-center mt-5'>No data found.</div>";
                    }
                    ?>
                </div>
                <div class="col-12 text-center mt-5" id="noResults" style="display: none;">
                    <h3>No results found</h3>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal Location Delete -->
<div class="modal fade" id="Modal_delete_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="location_code.php" method="POST">
            <input type="hidden" id="delete_id" name="location_id">
            <button type="submit" name="delete_location" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete location -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<script>
    function myFunction() {
        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('target');
        var resultsFound = false;

        for (i = 0; i < nodes.length; i++) {
            var productName = nodes[i].querySelector('.card-title').innerText.toLowerCase();
            if (productName.includes(filter)) {
                nodes[i].style.display = "block";
                resultsFound = true;
            } else {
                nodes[i].style.display = "none";
            }
        }

        var noResultsMsg = document.getElementById("noResults");
        if (resultsFound) {
            noResultsMsg.style.display = "none";
        } else {
            noResultsMsg.style.display = "block";
        }
    }
</script>
<?php include ('../includes/bottom.php'); ?>