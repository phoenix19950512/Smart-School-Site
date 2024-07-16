<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style>
  iframe {
    width: 0;
    height: 0;
    opacity: 0;
    visibility: hidden;
  }
  table {
    margin: 20px auto;
  }
  th, td {
    border: 1px solid #999;
    padding: 5px 10px;
  }
  td:has(input) {
    padding: 0;
  }
  td > input {
    padding: 5px 10px;
    border: 0;
  }
  input:focus-visible {
    outline: none;
  }
  td > i.fa-times {
    cursor: pointer;
    color: red;
  }
</style>
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<div class="content-wrapper" style="min-height: 946px; display: flex;">
    <section class="content" style="display: flex; flex-direction: column; width: 100%;">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-search"></i>
                Parameters for Report Templates
              </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12" style="text-align: center;">
                  <button type="button" id="addButton" class="btn btn-primary btn-sm checkbox-toggle">
                    <i class="fa fa-plus" style="margin-top: 4px; margin-right: 3px;"></i>
                    Add Item
                  </button>
                  <button type="button" id="saveButton" class="btn btn-success btn-sm checkbox-toggle" style="margin-left: 10px;">
                    <i class="fa fa-save" style="margin-top: 4px; margin-right: 3px;"></i>
                    Save
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                      <tr>
                        <th>Parameter Name</th>
                        <th>Table Name</th>
                        <th>Field Name</th>
                        <th>&nbsp;&nbsp;&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody id="parameters">
                      <?php foreach($params as $param) { ?>
                        <tr>
                          <td><input type="text" placeholder="Please Input" value="<?php echo $param->name; ?>"></td>
                          <td><input type="text" placeholder="Please Input" value="<?php echo $param->table; ?>"></td>
                          <td><input type="text" placeholder="Please Input" value="<?php echo $param->field; ?>"></td>
                          <td><i class="fa fa-times"></i></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
      $('#addButton').click(() => {
        $('#parameters').append(`<tr>
          <td><input type="text" placeholder="Please Input"></td>
          <td><input type="text" placeholder="Please Input"></td>
          <td><input type="text" placeholder="Please Input"></td>
          <td><i class="fa fa-times"></i></td>
        </tr>`);
        setDeleteActions();
      });
      $('#saveButton').click(() => {
        const params = [];
        const base_url = '<?php echo base_url() ?>';
        const trs = $('tbody > tr');
        for (const tr of trs) {
          params.push({
            name: $(tr).find('input').eq(0).val(),
            table: $(tr).find('input').eq(1).val(),
            field: $(tr).find('input').eq(2).val(),
          });
        }
        $.post(`${base_url}/report/manageparams`, { data: params }, (data, status) => {
          if (status === 'success') {
            alert('Successfully saved.');
          } else {
            alert('Failed to save parameters.');
          }
        })
      });
      const setDeleteActions = () => {
        $('tbody tr i.fa-times').click((e) => {
          e.target.parentElement.parentElement.remove();
        });
      }
      setDeleteActions();
    });
</script>