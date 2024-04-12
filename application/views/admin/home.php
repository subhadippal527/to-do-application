<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>To Do</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/style.css">
</head>
<body>

<div>
<a class="btn btn-primary" href="javascript:void(0);" id="logoutmodel">Logout</a>
</div>

<form role="form" id="Addtodo" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6 blog-name">
    <div class="form-group">
      <label for="addtodo">Add</label>
      <input type="text" id="task_add" name="task_add" class="form-control">
    </div>
    <div class="alert-message"></div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <input type="hidden" name="user_id" value="<?php echo $login_data[0]['id'];?>">
      <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
    </div>
  </div>
</div>
<input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
</form>
<?php
if(!empty($list_data)){
        $i=0;
        ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">SL NO</th>
      <th scope="col">Task</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($list_data as $sList){
          $i++;
        ?>
      <tr>
        <td><?php echo $i ;?></td>
        <td><?php echo $sList['task_add'] ; ?></td>
        <td>
            <?php 
                if($sList['status'] == 1){ ?>
                <a class="btn btn-sm btn-info change-status" data-value="0" data-id="<?php echo $sList['id'] ; ?>" href="javascript:void(0);"title="Pending">Pending</a>
            <?php
                } else {
            ?> 
            <a class="btn btn-sm btn-success change-status" data-value="1" data-id="<?php echo $sList['id'] ; ?> " href="javascript:void(0);"title="Completed">Completed</a>
            <?php } ?>
        </td>
        <td>
          <a class="btn btn-sm btn-info editRow" href="javascript:void(0);" data-id="<?php echo $sList['id'];?>" title="Edit">Edit</a>
          <a class="btn btn-sm btn-danger deleteRow" href="javascript:void(0);" data-delete-href="<?php echo base_url().'delete/'.$sList['id']; ?>" title="Delete">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php }?>

<!-- Modal -->
<div class="modal fade" id="exampleyyhhy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button type="button" class="close closeModel" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Select "Logout".
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeModel" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" href="<?php echo base_url()?>logout">Logout</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
        <button type="button" class="close closeModel" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Are you sure want to delete this Task.
      </div>
      <div class="modal-footer">
      <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn closeModel">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModel" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Task</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn closeModel">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
        <button type="button" class="close closeModel" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='Edittodo' method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="text" id="edit-task" name="task_add" class="form-control">
        <input type="hidden" id="hidden_id" name="hidden_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeModel" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </div>
      </form>
    </div>
  </div>
</div>

<script> var base_url = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url()?>assets/admin/js/jquery-min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/form_val.js"></script>
</body>
</html>