<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data         = explode('?', $current_page);
$role_id      = $this->session->userdata['logged_in']['role_id'];
$loginid      = $this->session->userdata['logged_in']['id'];
$current_page = current_url();
?>

<style>
    fieldset.scheduler-border {
        border-radius: 8px;
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        margin-top: 30px !important;
    }

    legend.scheduler-border {
        text-align: left !important;
        width: auto;
        margin-top: -30px;
        margin-left: 15px;
        color: #144277;
        font-size: 17px;
        margin-bottom: 0px;
        border: none;
        background: #fff;
        padding: 15px;
    }

    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 700;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }
    
</style>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- Display success message if any -->
        <span class="successs_mesg"><?= $this->session->flashdata('success'); ?></span>
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3 class="text-success">
                    <i class="fa fa-check-circle"></i> Success
                </h3>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Display failed message if any -->
        <?php if ($this->session->flashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3 class="text-warning">
                    <i class="fa fa-exclamation-triangle"></i> Warning
                </h3>
                <?= $this->session->flashdata('failed'); ?>
            </div>
        <?php endif; ?>

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">All Your Orders Details</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">All Your Orders Details</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- <h4 class="modal-title" id="exampleModalLabel1">Call Status Update</h4>  -->
                                                        <h4> leads id </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row col-md-12">
                                                            <div class="card-body" style="height:200px; overflow-y: auto; background-color:white;">
                                                                <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                                                                    <div class="call_message">
                                                                        <div class="d-flex flex-row justify-content-start">
                                                                        <div>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">Hi</p>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">How are you...???</p>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">What are you doing tomorrow? Can we come up a bar?</p>
                                                                            <p class="small ms-3 mb-3 rounded-3 text-muted">23:58</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                                                        <div>
                                                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Hiii, I'm good.</p>
                                                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">How are you doing?</p>
                                                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Long time no see! Tomorrow</p>
                                                                            <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">00:06</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-row justify-content-start">
                                                                        <div>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">Hi</p>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">How are you...???</p>
                                                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">What are you doing tomorrow? Can we come up a bar?</p>
                                                                            <p class="small ms-3 mb-3 rounded-3 text-muted">23:58</p>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <!-- <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/callstatusadd" enctype="multipart/form-data"> -->
                                                                <div class="row col-md-12 m_form" id="m_form">
                                                                    <div class="row col-md-12">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <input type="hidden" name="backurl" value="">
                                                                            <input type="hidden" class="m_lead_id" name="order_id" value="<?= $id ?>">
                                                                            <?php if($role_id == 6){ ?>
                                                                                <input type="hidden" class="" name="reciever_id" value="<?= $swid ?>">
                                                                            <?php } elseif($role_id==7 ){?>
                                                                                <input type="hidden" class="" name="reciever_id" value="<?= $wid ?>">
                                                                            <?php } ?>
                                                                            <div style="display:flex">
                                                                                <textarea type="text" id="m_des" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                                                                <button id="send_message" type="submit"><i class="fas fa-paper-plane"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- </form> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->

<script>
   // Function to handle form submission
function sendMessage() {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the form data
    const formData = new FormData(document.getElementById("messageForm"));

    // Make an AJAX request to submit the form data
    fetch("your_php_script_to_handle_ajax_request.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response (if needed)
        // For example, you can display the new message in the messageContainer
        if (data.success) {
            const newMessage = document.createElement("p");
            newMessage.textContent = data.message;
            document.getElementById("messageContainer").appendChild(newMessage);
        } else {
            // Handle error scenario if necessary
            console.error("Error: " + data.error);
        }
    })
    .catch(error => {
        // Handle error scenario if necessary
        console.error("Error: " + error);
    });
}

// Add a listener to the form submit event
document.getElementById("messageForm").addEventListener("submit", sendMessage);

</script>


<script>
    $(document).on('click', '#send_message', function() {
        var order_id = $(this).closest("div.m_form").find("input[name='order_id']").val();
        var description = $(this).closest("div.m_form").find("textarea[name='description']").val();
        var reciever_id = $(this).closest("div.m_form").find("input[name='reciever_id']").val();

        // Log data to the browser console
        console.log("order_id:", order_id);
        console.log("description:", description);
        console.log("reciever_id:", reciever_id);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/Leads/callstatusaddwrite',
            data: {
                order_id: order_id,
                description: description,
                reciever_id: reciever_id,
            },
            success: function(response) {
                console.log("AJAX response:", response);
                // Handle the AJAX response here if needed
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                // Handle AJAX errors here if needed
            }
        });
    });
</script>



