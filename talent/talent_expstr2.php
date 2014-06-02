<?php
include '../common_include_in.php';
include '../include/header_in.php';
?>
<?php
include '../include/top_navigation.php';

?>
<div class="container-fluid" id="content">
<?php include '../include/left_navigation_in.php'; ?>
    <div id="main">
        <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">
                    <h1>Talent Management</h1>
                </div>
            </div>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="../dashboard.php">Home</a> <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Talent Management</a>
                    </li>
                </ul>
                <div class="close-bread">
                    <a href="#"><i class="icon-remove"></i> </a>
                </div>
            </div>
            <br/>
            <div>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_speed1.php">Speed T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_speed2.php">Speed T2</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_expstr1.php">Explosive Strength T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_expstr2.php">Explosive Strength T2</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_str1.php">Strength T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_str2.php">Strength T2</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_ubs1.php">Upper Body Strength T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_ubs2.php">Upper Body Strength T2</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_agility1.php">Agility T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_agility2.php">Agility T2</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_flexibilty1.php">Flexibility T1</a></button>
                <button class="btn btn-mini btn-warning pull-right" style="float: left; margin-right: 8px;"><a href="talent_flexibilty2.php">Flexibility T2</a></button>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-color box-bordered">
                        <div class="box-title">
                            <h3>
                                <i class="icon-table"></i>
                                Talent Search Details
                            </h3>
                        </div>
                        <div class="box-content nopadding">
			<table class="table table-nomargin dataTable table-bordered">
                                <thead>
                                    <tr>
                                        <th class='hidden-350'>S.No</th>
                                        <th class='hidden-1024'>Student Name</th>
                                        <th class='hidden-1024'>Grade</th>
                                        <th class='hidden-1024'>Section</th>
                                        <th class='hidden-1024'>Explosive Strength T2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php      
                                        $i=1;
                                        $result = mysql_query("select * from student_report order by exp_strength2 ASC limit 0,5");
                                        while ($row = mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td class='hidden-350'><?php echo $i; ?></td>
                                            <td class='hidden-1024'>
                                                <?php
                                                $fetchstudent = mysql_query("select * from student where student_id='" . $row['student_id'] . "'");
                                                $resultstudent = mysql_fetch_array($fetchstudent);
                                                echo $resultstudent['first_name']." ".$resultstudent['last_name'];
                                                ?>
                                            </td>
                                            <td class='hidden-1024'><?php echo $row['class_id']; ?></td>
                                            <td class='hidden-1024'><?php echo $row['section']; ?></td>
                                            <td class='hidden-1024'><?php echo $row['exp_strength2']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






