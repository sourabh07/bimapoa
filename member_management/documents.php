<?php
include '../common_include_in.php';
include '../include/header_in.php';
include '../include/top_navigation_in.php';

$memberobj = new Members();
$memberobj->connect();

if ($_POST['submitted']) {
    if ($memberobj->RegisterMember()) {
        $memberobj->RedirectToURL("manage_members.php");
    }
}

if (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
} else {
    header("Location: ../index.php");
}
$member_id = $_GET['member_id'];
$result = mysql_query("select * from bimapoa_members where member_id='" . $member_id . "'");
$row = mysql_fetch_array($result);
$resultdoc = mysql_query("select * from documents where policy_no='" . $row['policy_no'] . "'");
$rowdoc = mysql_fetch_array($resultdoc);
?>
<div class="container-fluid" id="content">
<?php include '../include/left_navigation_in.php'; ?>
    <div id="main">
        <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">
                    <h1>Manage Member Document</h1>
                </div>

            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Manage Member Document</a>
                    </li>
                </ul>

                <div class="close-bread">
                    <a href="#"><i class="icon-remove"></i> </a>
                </div>
            </div>

            <!-- 	<div class="row-fluid">
                    <div class="span12">

                            <div class="box box-color box-bordered blue">
                                    <div class="box-title">
                                            <h3>
                                                    <i class="icon-table"></i> Upload CSV
                                            </h3>
                                    </div>
                                    <div class="box-content nopadding">
                                            <form action="upload.php" method="post"
                                                    enctype="multipart/form-data">
                                                    <br /> <input type="file" name="data" /> <input type="submit"
                                                            name="submit" value="Upload">
                                            </form>
                                    </div>
                            </div>
                    </div>
            </div> -->
            <div class="row-fluid">
                <div class="span12">

                    <div class="box box-color box-bordered blue">
                        <div class="box-title">
                            <h3>
                                <i class="icon-table"></i> Member Document Details
                            </h3>
                        </div>
<?php
if ($rowdoc['document1'] != "") {
    ?>
                            <div class="box-content nopadding" align = "center">
                                <br/>
                                <a class="btn btn-primary" target = "_blank"   href='../uploads/<?php echo $rowdoc['document1'] ?>'><strong>View Document 1</strong></a>
                                <br/>   <br/>
                            </div>

    <?php
} else {
    ?>
                            <div class="box-content nopadding" align = "center">
                                <br/>
                            <strong>N/A</strong>
                            <br/><br/>
                            </div>
                            <?php
                        }
                        if ($rowdoc['document2'] != "") {
                            ?>
                            <div class="box-content nopadding" align = "center">
                                <br/>
                                <a class="btn btn-primary" target = "_blank"   href='../uploads/<?php echo $rowdoc['document2'] ?>'><strong>View Document 2</strong></a>
                                <br/><br/>
                            </div>
                            <?php
                        } else {
                            ?>
                             <div class="box-content nopadding" align = "center">
                                <br/>
                            <strong>N/A</strong>
                            <br/><br/>
                            </div>
    <?php
}
if ($rowdoc['document3'] != "") {
    ?>
                            <div class="box-content nopadding" align = "center">
                                 <br/>
                                <a class="btn btn-primary" target = "_blank"   href='../uploads/<?php echo $rowdoc['document3'] ?>'><strong>View Document 3</strong></a>
                           <br/><br/>
                            </div>
                        <?php
                        } else {
                            ?>
                            <div class="box-content nopadding" align = "center">
                                <br/>
                            <strong>N/A</strong>
                            <br/><br/>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
