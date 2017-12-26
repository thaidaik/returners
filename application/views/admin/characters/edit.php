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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> character updated with success.';
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

      //form validation
      echo validation_errors();

      echo form_open('admin/characters/update/'.$this->uri->segment(4).'', $attributes);

      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $character[0]['name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Image</label>
            <div class="controls">
              <input type="text" id="" name="image" value="<?php echo $character[0]['image']; ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Info</label>
            <div class="controls">
              <input type="text" id="" name="info" value="<?php echo $character[0]['info'];?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
			<div class="control-group">
				<label for="inputError" class="control-label">Status</label>
				<div class="controls">
					<select name="status">
						<option <?php if( $character[0]['status'] == 1){ echo 'selected';}?> value="1">Yes</option>
						<option <?php if( $character[0]['status'] == 0){ echo 'selected';}?> value="0">No</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">HP Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="hp_1" type="checkbox" value="1" <?php if($character[0]['hp_1'] == '1'){ echo 'checked';}?>>HP0 1</label>
					<label class="checkbox inline"><input name="hp_2" type="checkbox" value="1" <?php if($character[0]['hp_2'] == '1'){ echo 'checked';}?>>HP0 2</label>
					<label class="checkbox inline"><input name="hp_3" type="checkbox" value="1" <?php if($character[0]['hp_3'] == '1'){ echo 'checked';}?>>HP0 3</label>
					<label class="checkbox inline"><input name="hp_4" type="checkbox" value="1" <?php if($character[0]['hp_4'] == '1'){ echo 'checked';}?>>HP0 4</label>
					<label class="checkbox inline"><input name="hp_5" type="checkbox" value="1" <?php if($character[0]['hp_5'] == '1'){ echo 'checked';}?>>HP0 5</label>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">ATK Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="atk_1" type="checkbox" value="1" <?php if($character[0]['atk_1'] == '1'){ echo 'checked';}?>>ATK 1</label>
					<label class="checkbox inline"><input name="atk_2" type="checkbox" value="1" <?php if($character[0]['atk_2'] == '1'){ echo 'checked';}?>>ATK 2</label>
					<label class="checkbox inline"><input name="atk_3" type="checkbox" value="1" <?php if($character[0]['atk_3'] == '1'){ echo 'checked';}?>>ATK 3</label>
					<label class="checkbox inline"><input name="atk_4" type="checkbox" value="1" <?php if($character[0]['atk_4'] == '1'){ echo 'checked';}?>>ATK 4</label>
					<label class="checkbox inline"><input name="atk_5" type="checkbox" value="1" <?php if($character[0]['atk_5'] == '1'){ echo 'checked';}?>>ATK 5</label>
				</div>
			</div>
			<div class="control-group">
				<label for="inputError" class="control-label">DEF Story</label>
				<div class="controls">
					<label class="checkbox inline"><input name="def_1" type="checkbox" value="1" <?php if($character[0]['def_1'] == '1'){ echo 'checked';}?>>DEF 1</label>
					<label class="checkbox inline"><input name="def_2" type="checkbox" value="1" <?php if($character[0]['def_2'] == '1'){ echo 'checked';}?>>DEF 2</label>
					<label class="checkbox inline"><input name="def_3" type="checkbox" value="1" <?php if($character[0]['def_3'] == '1'){ echo 'checked';}?>>DEF 3</label>
					<label class="checkbox inline"><input name="def_4" type="checkbox" value="1" <?php if($character[0]['def_4'] == '1'){ echo 'checked';}?>>DEF 4</label>
					<label class="checkbox inline"><input name="def_5" type="checkbox" value="1" <?php if($character[0]['def_5'] == '1'){ echo 'checked';}?>>DEF 5</label>
				</div>
			</div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     