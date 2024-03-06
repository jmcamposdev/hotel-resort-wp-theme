<div class="custom-array-metabox">
  <table class="amenities-table">
    <thead>
      <tr>
        <th class="th-name">Name</th>
        <th class="th-rol"></th>
        <th class="th-delete"></th>
      </tr>
    </thead>
    <tbody id="custom-array-tbody">
      <?php
        if (!empty($custom_array_values)) {

          foreach ($custom_array_values as $index => $row) {
        ?>
        
        <tr>
          <td><input type="text" class="td-name" name="jmc_custom_array_field[<?php echo $index ?>][key1]" value="<?php echo $row['key1'] ?>" id=""></td>
          <td><button type="button" id="remove-row" class="td-delete button button-primary"><span class="dashicons dashicons-dismiss"></span>&nbsp;Remove</button></td>
        </tr>

        <?php
        }
      } else {

        ?>
        <tr>
          <td><input type="text" class="td-name" name="jmc_custom_array_field[0][key1]" value="" id=""></td>
          <td><button type="button" id="remove-row" class="td-delete button button-primary"><span class="dashicons dashicons-dismiss"></span>&nbsp;Remove</button></td>
        </tr>
        <?php
      }
      ?>

    </tbody>
  </table>

  <p>
    <button type="button" class="button button-primary" id="add-row"><span class="dashicons dashicons-insert"></span>&nbsp;Add</button>
  </p>
</div>