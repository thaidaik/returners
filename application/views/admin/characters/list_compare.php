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
          List Compare
          
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
           
            <?php
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
            echo form_open('admin/list_compare_kq', $attributes);
            ?>


          <table class="table table-striped table-bordered table-condensed" id="list_compare">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Key</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $i=1;
              foreach($characters as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td class="key-actions">
					<label class="checkbox inline"><input name="list_compare[]" type="checkbox" value="'.$row['id'].'" >Click to Select</label>
                </td>';
                echo '<td class="crud-actions">
					<label class="checkbox inline"><input ';
				if($i <6){
					echo 'checked="checked"';
				}
				echo ' name="list_compare[]" type="checkbox" value="'.$row['id'].'" >Click to Select</label>
                </td>';
                echo '</tr>';
				$i++;
              }
              ?>      
            </tbody>
          </table>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script>
			$(window).on('load', function () {
				$('.crud-actions input[type=checkbox]').change(function(e){
					if ($('.crud-actions input[type=checkbox]:checked').length > 11) {
						$(this).prop('checked', false)
						alert("Chọn nhiều nhất 11 heroes");
					}else if ($('.crud-actions input[type=checkbox]:checked').length < 5) {
						$(this).prop('checked', true)
						alert("Chọn ít nhất 5 heroes");
					}
					//alert ($('.crud-actions input[type=checkbox]').is(":checked"));
					var data_check = $('.crud-actions input[type=checkbox]').val();
				})
				$('.key-actions input[type=checkbox]').change(function(e){
				   if ($('.key-actions input[type=checkbox]:checked').length > 2) {
						$(this).prop('checked', false)
						alert("Chọn nhiều nhất 2 keys");
				   }
				})
				$('button').click(function(){    
					if(this.id == 'btn1'){
						$('.showbtn2').show();
						$('.form-actions').hide();
					}
				})
			})
			</script>
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		   <fieldset>
			<div class="control-group">
				<label class="radio">
				<input type="radio" name="filter" id="optionsRadios1" value="5" checked>
				Show all data >= 5 active tags
				</label>
				<label class="radio">
				<input type="radio" name="filter" id="optionsRadios2" value="6">
				Show all data >= 6 active tags
				</label>
			</div>
			</fieldset>
		  <div class="form-actions">
            <button class="btn btn-primary" type="submit" id="btn1">Submit</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
		  <div class="loader showbtn2"></div>
		  <div class="loader_mess showbtn2">Loading...</div>
			<?php echo form_close();
			?>
      </div>
    </div>