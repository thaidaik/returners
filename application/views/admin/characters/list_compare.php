    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
           
            <?php
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
            echo form_open('admin/characters/list_compare_kq', $attributes);
            ?>


          <table class="table table-striped table-bordered table-condensed" id="list_compare">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">name</th>
                <th class="green header">image</th>
                <th class="red header">info</th>
                <th class="red header">status</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($characters as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['image'].'</td>';
                echo '<td>'.$row['info'].'</td>';
                echo '<td>'.$row['status'].'</td>';
                echo '<td class="crud-actions">
					<label class="checkbox inline"><input name="list_compare[]" type="checkbox" value="'.$row['id'].'">Click to Select</label>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script>
			$(window).on('load', function () {
				$('input[type=checkbox]').change(function(e){
				   if ($('input[type=checkbox]:checked').length > 10) {
						$(this).prop('checked', false)
						alert("allowed only 10 items");
				   }else if ($('input[type=checkbox]:checked').length < 5) {
						$(this).prop('checked', false)
						alert("allowed only 5 items");
				   }
				})
			})
			</script>
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		  <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
			<?php echo form_close();
			?>
      </div>
    </div>