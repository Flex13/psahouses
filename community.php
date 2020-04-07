<?php $page_title = 'PSA Houses - Status Updates'; ?>
<?php include('includes/header.php'); ?>

<?php PostStatus:: insertStatus();?>
<section class="gallery-block cards-gallery text-center ">
    <div class="container-fluid">
        <div class="row">

            <!-- Main Area -->

            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row justify-content-center">
                    <div class="col-6">
                    <?php echo display_error(); ?>
                    <?php echo display_success(); ?>
                    </div>
                </div>


                <section class='container'>
                    <h2 class="status-title"><b>Update Your Status</b></h2>
                    <div class='row p-3'>
                        <div class='col-sm-12'>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post' enctype='multipart/form-data'>
                                <textarea class='form-control mb-2' name='status_description' placeholder='What is on your mind?' cols='30' rows='2'></textarea>


                                <label class="upload-button" style='float:left;'>
                                    <input type="file" name='upload_image' size='30' />
                                    Upload Picture
                                </label>

                                <button id='btn-post' class='btn bts-success' name='submit' style='float:right; width: 80px;'>Post</button>

                            </form>
                        </div>
                    </div>
                </section>



                <h2 class="status-main-title">Community Updates</h2>
                <p class="text-center status-sub-title">Latest Community Updates</p>





            </div>
        </div>
    </div>
</section>
<!-- Sider Area -->
<?php include('includes/footer.php'); ?>