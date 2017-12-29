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
          <table class="table table-striped table-bordered table-condensed" id="list_compare">
            <thead>
              <tr>
                <th class="yellow header headerSortDown">Name</th>
                <th class="red header">Story</th>
                <th class="red header">Active</th>
              </tr>
            </thead>
            <tbody>
              <?php
				$array_story = array(
					'hp_1' => 'HP 1',
					'hp_2' => 'HP 2',
					'hp_3' => 'HP 3',
					'hp_4' => 'HP 4',
					'hp_5' => 'HP 5',
					'atk_1' => 'ATK 1',
					'atk_2' => 'ATK 2',
					'atk_3' => 'ATK 3',
					'atk_4' => 'ATK 4',
					'atk_5' => 'ATK 5',
					'def_1' => 'DEF 1',
					'def_2' => 'DEF 2',
					'def_3' => 'DEF 3',
					'def_4' => 'DEF 4',
					'def_5' => 'DEF 5',
				);
				foreach($final_data as $row)
				{
					$data_story_total = '';
					if(isset($row['hp_1'])){
						$data_story_total .= '['.$array_story['hp_1'].' x '.$row['hp_1'].']'.' - ';
					}
					if(isset($row['hp_2'])){
						$data_story_total .= '['.$array_story['hp_2'].' x '.$row['hp_2'].']'.' - ';
					}
					if(isset($row['hp_3'])){
						$data_story_total .= '['.$array_story['hp_3'].' x '.$row['hp_3'].']'.' - ';
					}
					if(isset($row['hp_4'])){
						$data_story_total .= '['.$array_story['hp_4'].' x '.$row['hp_4'].']'.' - ';
					}
					if(isset($row['hp_5'])){
						$data_story_total .= '['.$array_story['hp_5'].' x '.$row['hp_5'].']'.' - ';
					}
					if(isset($row['atk_1'])){
						$data_story_total .= '['.$array_story['atk_1'].' x '.$row['atk_1'].']'.' - ';
					}
					if(isset($row['atk_2'])){
						$data_story_total .= '['.$array_story['atk_2'].' x '.$row['atk_2'].']'.' - ';
					}
					if(isset($row['atk_3'])){
						$data_story_total .= '['.$array_story['atk_3'].' x '.$row['atk_3'].']'.' - ';
					}
					if(isset($row['atk_4'])){
						$data_story_total .= '['.$array_story['atk_4'].' x '.$row['atk_4'].']'.' - ';
					}
					if(isset($row['atk_5'])){
						$data_story_total .= '['.$array_story['atk_5'].' x '.$row['atk_5'].']'.' - ';
					}
					if(isset($row['def_1'])){
						$data_story_total .= '['.$array_story['def_1'].' x '.$row['def_1'].']'.' - ';
					}
					if(isset($row['def_2'])){
						$data_story_total .= '['.$array_story['def_2'].' x '.$row['def_2'].']'.' - ';
					}
					if(isset($row['def_3'])){
						$data_story_total .= '['.$array_story['def_3'].' x '.$row['def_3'].']'.' - ';
					}
					if(isset($row['def_4'])){
						$data_story_total .= '['.$array_story['def_4'].' x '.$row['def_4'].']'.' - ';
					}
					if(isset($row['def_5'])){
						$data_story_total .= '['.$array_story['def_5'].' x '.$row['def_5'].']'.' - ';
					}
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$data_story_total.'</td>';
					echo '<td>'.$row['total'].'</td>';
					echo '</tr>';
				}
              ?>      
            </tbody>
          </table>
		  <div class="form-actions">
            <button class="btn btn-primary" type="submit" onclick="window.history.go(-1)">Back</button>
          </div>
			
      </div>
    </div>