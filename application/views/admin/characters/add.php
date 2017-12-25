    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new character created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/characters/add', $attributes);
      ?>
        <fieldset>
			<div class="control-group">
				<label for="inputError" class="control-label">Name</label>
				<div class="controls">
				<input type="text" id="" name="name" value="<?php echo set_value('name'); ?>" >
				<!--<span class="help-inline">Woohoo!</span>-->
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">Image</label>
				<div class="controls">
				<input type="text" id="" name="image" value="<?php echo set_value('image'); ?>">
				<!--<span class="help-inline">Cost Price</span>-->
				</div>
			</div>          
			<div class="control-group">
				<label for="inputError" class="control-label">Info</label>
				<div class="controls">
					<input type="text" id="" name="info" value="<?php echo set_value('info'); ?>">
				<!--<span class="help-inline">Cost Price</span>-->
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">Status</label>
				<div class="controls">
					<select name="status">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">HP Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="hp_1" type="checkbox" value="HP 1">HP 1</label>
					<label class="checkbox inline"><input name="hp_2" type="checkbox" value="HP 2">HP 2</label>
					<label class="checkbox inline"><input name="hp_3" type="checkbox" value="HP 3">HP 3</label>
					<label class="checkbox inline"><input name="hp_4" type="checkbox" value="HP 4">HP 4</label>
					<label class="checkbox inline"><input name="hp_5" type="checkbox" value="HP 5">HP 5</label>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">ATK Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="atk_1" type="checkbox" value="ATK 1">ATK 1</label>
					<label class="checkbox inline"><input name="atk_2" type="checkbox" value="ATK 2">ATK 2</label>
					<label class="checkbox inline"><input name="atk_3" type="checkbox" value="ATK 3">ATK 3</label>
					<label class="checkbox inline"><input name="atk_4" type="checkbox" value="ATK 4">ATK 4</label>
					<label class="checkbox inline"><input name="atk_5" type="checkbox" value="ATK 5">ATK 5</label>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">DEF Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="def_1" type="checkbox" value="DEF 1">DEF 1</label>
					<label class="checkbox inline"><input name="def_2" type="checkbox" value="DEF 2">DEF 2</label>
					<label class="checkbox inline"><input name="def_3" type="checkbox" value="DEF 3">DEF 3</label>
					<label class="checkbox inline"><input name="def_4" type="checkbox" value="DEF 4">DEF 4</label>
					<label class="checkbox inline"><input name="def_5" type="checkbox" value="DEF 5">DEF 5</label>
				</div>
			</div>
			
			
			
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     