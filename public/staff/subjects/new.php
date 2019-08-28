<?php 

require_once('../../../private/initialize.php');

$menu_name = '';
$position = '';
$visible = '' ;

if(is_post_request()){

    // Handle values sent by new.php
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '' ;
    
    if(insert_subject($menu_name,$position,$visible)){
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));       
    }else{
        echo "Error Creating Subject: " . mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

?>

<?php $page_title = 'Create Subject' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to list</a></div>

    <div class="subject new">
        <h1>Create Subject</h1>

        <form action="<?php echo url_for('/staff/subjects/new.php')?>" method="post">
            <dl>
                <dt>Menu name</dt>
                <dd><input type='text' name='menu_name' value="<?php 
                    echo h($menu_name); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($position == "1"){ echo " selected";}?>>1</option>                           <option value="2"<?php if($position == "2"){ echo " selected";}?>>2</option>    
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input name="visible" type="hidden" value="0"/>
                    <input name="visible" type="checkbox" value="1" <?php if($visible == "1"){ echo "checked"; } ?>/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" name="submit" value="Create Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>